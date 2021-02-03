import os, sys

IP = sys.argv[1]
a = float(sys.argv[2])
BFImax = float(sys.argv[3])


# 경로설정
path = os.getcwd()+'/'
log_path = path+'input/'+IP+'/'
log = open(log_path+IP+'_sys_log.txt','a')

log.write("Original Separation Has Been Selected.\n")
log.write("a Paramter is ::" + str(a) + '\n')
log.write("BFImax is ::" + str(BFImax) + '\n')

# 유량자료 파일을 역순으로 계산하여 BFI max 계산하기
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
		ebf_value = round((((1 - BFImax) * a * ebf_data[i - 1]) + ((1 - a) * BFImax * strf_data[i][1])) / (1 - a * BFImax), 3)
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
print ("BFImax of Original Separation is :: "+str(bfimax))

result_file = open('original_result.csv','w')
result_file.write('Date,Streamflow(CMS),Baseflow(CMS)\n')

for i in range(len(strf_data)):
	result_file.write(str(strf_data[i][0])+','+str(strf_data[i][1])+','+str(ebf_data[i])+'\n')
result_file.close()
log.write('Result file "original_result.csv" exported.\n')
log.close()