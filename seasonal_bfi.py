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

print (a_par_lines)
print (a_par)

log.write('a Parameters Read.\n')


#	유량자료 파일을 역순으로 계산하여 BFI max 계산하기
strf_file = open('streamflow.csv','r')
strf_data = strf_file.readlines()
strf_data = strf_data[1:]
for i in range(len(strf_data)):
	print (strf_data[i])
	strf_data[i] = strf_data[i].replace('\n','')
	strf_data[i] = strf_data[i].split(',')
	strf_data[i][1] = float(strf_data[i][1])
log.write('Reading Streamflow Data.\n\n')


#	Inverse filter 를 사용한 BFI max 산정
for i in range(len(strf_data)-1,-1,-1):	
	print (i)
	#	마지막 유량은 * 0.5
	if i == len(strf_data)-1:
		strf_data[i].append(strf_data[i][1] * 0.5)
		print('last day::')
	else:
		#	Spring(3~5)
		if int(strf_data[i][0].split('-')[1]) in [3,4,5]:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[0] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[0],2))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

		#	Summer(6~8)
		elif int(strf_data[i][0].split('-')[1]) in [6,7,8]:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[1] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[1],2))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

		#	Autumn(9~11)
		elif int(strf_data[i][0].split('-')[1]) in [9,10,11]:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[2] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[2],2))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

		#	Winter(12~2)
		else:
			#	산정된 기저유량이 전일보다 작은 경우
			print('>>>', i)
			print('>>>', type(strf_data[i + 1][2]), type(a_par[3]), type(strf_data[i][1]))
			print('>>>', strf_data[i + 1][2], a_par[3], strf_data[i][1])
			if strf_data[i+1][2]/a_par[3] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[3],2))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])
	print(strf_data[i])


#	Inverse filter 결과를 활용하여 BFImax 산정
bfi = 0
strf = 0
for i in range(len(strf_data)):
	strf = strf+strf_data[i][1]
	bfi = bfi+strf_data[i][2]

bfimax = round(bfi/strf,2)
print ('')
print("BFImax of Seasonal is :: " + str(bfimax))


log.write('BFImax Calculation Done.\n')
log.write('BFImax is ::' + str(bfimax) + '\n')
log.write('===============================================\n\n')
log.close()

#	BFI max 계산결과 Web으로 반환
f = open('seasonal_a.csv','a')
f.write('BFImax,'+str(bfimax))
f.close()