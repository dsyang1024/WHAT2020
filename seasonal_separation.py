import os, sys

# 경로설정
IP = sys.argv[1]

# 경로설정
path = os.getcwd()+'/'
log_path = path+'input/'+IP+'/'
log = open(log_path+IP+'_sys_log.txt','a')

#	a parameter 파일의 값 읽어오기
f = open('seasonal_a.csv','r')
a_par_lines = f.readlines()
a_par = []
f.close()

for i in range(len(a_par_lines)):
	a_par_lines[i] = a_par_lines[i].replace('\n','')
	a_par_lines[i] = a_par_lines[i].split(',')
	a_par_lines[i][1] = float(a_par_lines[i][1])
	a_par.append(a_par_lines[i][1])
# a par // BFImax 값 설정
BFImax = a_par[-1]
a_par = a_par[:-1]

print ('BFImax is :: ',BFImax)
print (a_par)

log.write('Parameter Data Interpreted.\n\n')

#	유량자료 파일을 역순으로 계산하여 BFI max 계산하기
strf_file = open('streamflow.csv','r')
strf_data = strf_file.readlines()
strf_data = strf_data[1:]
for i in range(len(strf_data)):
	strf_data[i] = strf_data[i].replace('\n','')
	strf_data[i] = strf_data[i].split(',')
	strf_data[i][1] = float(strf_data[i][1])


# 기저유량 데이터 추가할 리스트 생성
ebf_data = []

# Eckhardt filter 를 사용한 기저유출 산정
for i in range(len(strf_data)):	
	
 	#	첫 유량은 * 0.5
	if i == 0:
		ebf_value = round(strf_data[i][1]*0.5,3)
		ebf_data.append(ebf_value)
  
	else:
		#	Spring(3~5)
		if int(strf_data[i][0].split('-')[1]) in [3,4,5]:
			a = a_par[0]
			ebf_value=round((((1-BFImax)*a*ebf_data[i-1])+((1-a)*BFImax*strf_data[i][1]))/(1-a*BFImax),3)
			#	산정된 기저유량이 전일보다 큰 경우 하천유량으로 대체
			if ebf_value > strf_data[i][1]:
				ebf_value = strf_data[i][1]
			ebf_data.append(ebf_value)
   
		#	Summer(6~8)
		elif int(strf_data[i][0].split('-')[1]) in [6,7,8]:
			a = a_par[1]
			ebf_value=round((((1-BFImax)*a*ebf_data[i-1])+((1-a)*BFImax*strf_data[i][1]))/(1-a*BFImax),3)
			#	산정된 기저유량이 전일보다 큰 경우 하천유량으로 대체
			if ebf_value > strf_data[i][1]:
				ebf_value = strf_data[i][1]
			ebf_data.append(ebf_value)


		#	Autumn(9~11)
		elif int(strf_data[i][0].split('-')[1]) in [9,10,11]:
			a = a_par[2]
			ebf_value=round((((1-BFImax)*a*ebf_data[i-1])+((1-a)*BFImax*strf_data[i][1]))/(1-a*BFImax),3)
			#	산정된 기저유량이 전일보다 큰 경우 하천유량으로 대체
			if ebf_value > strf_data[i][1]:
				ebf_value = strf_data[i][1]
			ebf_data.append(ebf_value)

		#	Winter(12~2)
		else:
			a = a_par[3]
			ebf_value=round((((1-BFImax)*a*ebf_data[i-1])+((1-a)*BFImax*strf_data[i][1]))/(1-a*BFImax),3)
			#	산정된 기저유량이 전일보다 큰 경우 하천유량으로 대체
			if ebf_value > strf_data[i][1]:
				ebf_value = strf_data[i][1]
			ebf_data.append(ebf_value)

log.write('Baseflow Calculation Done.\n')

#	Inverse filter 결과를 활용하여 BFImax 산정
bfi = 0
strf = 0
for i in range(len(strf_data)):
	strf = strf+strf_data[i][1]
	bfi = bfi+ebf_data[i]

bfimax = round(bfi/strf,3)
print ('')
print ("BFImax of Seasonal Separation is :: "+str(bfimax))

result_file = open('seasonal_result.csv','w')
result_file.write('Date,Streamflow(CMS),Baseflow(CMS)\n')

for i in range(len(strf_data)):
	result_file.write(str(strf_data[i][0])+','+str(strf_data[i][1])+','+str(ebf_data[i])+'\n')
result_file.close()
log.write('Result file "seasonal_result.csv" exported.\n')
log.close()

