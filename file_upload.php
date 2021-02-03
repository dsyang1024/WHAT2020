<?php
$ip_address = $_SERVER["REMOTE_ADDR"];
$file_name = $_FILES['upload_file']['name'];                // 업로드한 파일명
$file_tmp_name = $_FILES['upload_file']['tmp_name'];   // 임시 디렉토리에 저장된 파일명
$file_size = $_FILES['upload_file']['size'];                 // 업로드한 파일의 크기
$mimeType = $_FILES['upload_file']['type'];                 // 업로드한 파일의 MIME Type

exec("python3 ./file_set.py $ip_address");

// 첨부 파일이 저장될 서버 디렉토리 지정(원하는 경로에 맞게 수정하세요)
// ysep을 구동하기 위한 환경 구축하기
// 1. IP별로 경로 만들기
mkdir("./input/$ip_address",0777);


// 2. 경로 확인
// $save_dir = "input/$ip_address/";
$save_dir = "./";
// 3. IP별 경로에 Y-SEP 엔진 복사하기
// 엔진 경로 == ./y-sep/engine
// system("cp -pf ./engine/seasonal_array.py $save_dir/seasonal_array.py");
// system("cp -pf ./engine/seasonal_ML.py $save_dir/seasonal_ML.py");
// system("cp -pf ./engine/seasonal_bfi.py $save_dir/seasonal_bfi.py");
// system("cp -pf ./engine/seasonal_separation.py $save_dir/seasonal_separation.py");



// 업로드 파일 확장자 검사 (필요시 확장자 추가)
   if($mimeType=="html" || 
   $mimeType=="py" ||
   $mimeType=="csv" ||
   $mimeType=="") { 
	   echo("<script>
	   alert('$mimeType');
	   alert('업로드를 할 수 없는 파일형식입니다.'); 
	   document.location.href = './upload.php';
		</script>"); 
		exit;
		
	} 
	// 파일명 변경 (업로드되는 파일명을 별도로 생성하고 원래 파일명을 별도의 변수에 지정하여 DB에 기록할 수 있습니다.)
	
	
	$real_name = $file_name;     // 원래 파일명(업로드 하기 전 실제 파일명) 
	$arr = explode(".", $real_name);	 // 원래 파일의 확장자명을 가져와서 그대로 적용 $file_exe	
	$arr1 = $arr[0];	
	$arr2 = $arr[1];	
	$arr3 = $arr[2];	
	$arr4 = $arr[3];	

	if($arr4) { 
		$file_exe = $arr4;
	} else if($arr3 && !$arr4) { 
		$file_exe = $arr3;					
	} else if($arr2 && !$arr3) { 
		$file_exe = $arr2;					
	}


	// $file_time = time(); 
	$file_Name = "streamflow".".".$file_exe;	 // 실제 업로드 될 파일명 생성	(본인이 원하는 파일명 지정 가능)	 
	$change_file_name = $file_Name;			 // 변경된 파일명을 변수에 지정 
	$real_name = addslashes($real_name);		// 업로드 되는 원래 파일명(업로드 하기 전 실제 파일명) 
	$real_size = $file_size;                         // 업로드 되는 파일 크기 (byte)

//파일을 저장할 디렉토리 및 파일명 전체 경로
   $dest_url = $save_dir . $change_file_name;

//파일을 지정한 디렉토리에 업로드
   if(!move_uploaded_file($file_tmp_name, $dest_url)) {
      die("파일을 지정한 디렉토리에 업로드하는데 실패했습니다.");
   }

// DB에 기록할 파일 변수 (DB에 저장이 필요한 경우 아래 변수명을 기록하시면 됩니다.)
/*
	$change_file_name : 실제 서버에 업로드 된 파일명. 예: file_145736478766.gif
	$real_name : 원래 파일명. 예: 풍경사진.gif 
	$real_size : 파일 크기(byte)
*/
	// header("location:./file_upload01.php");    
	echo("<script>
			alert('Upload streamflow data successful! Click separation method'); 
			document.location.href = './upload.php';
			</script>");
	// exec("C:/Python/python C:/inetpub/wwwroot/APEX/y-sep/input.py $ip_address");
?>