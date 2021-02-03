import os, sys


# 경로설정
IP = sys.argv[1]

# 경로설정
path = os.getcwd()+'/'
log_path = path+'input/'+IP+'/'
log = open(log_path+IP+'_sys_log.txt','a')



#	a parameter 파일의 값 읽어오기
f = open('regime_a.csv','r')
fline = f.readlines()
f.close()

# a par 값 정리하기
fline = fline[2:-1]
for i in range(len(fline)):
	fline[i] = fline[i].replace('\n', '')
	fline[i] = fline[i].split(',')

flow_par = []
a_par = []
for i in range(len(fline)):
	try:
		flow_par.append(float(fline[i][2]))
	except:
		pass
	a_par.append(float(fline[i][-1]))

log.write('a Parameters Read.\n')



#	유량자료 파일을 역순으로 계산하여 BFI max 계산하기
strf_file = open('streamflow.csv','r')
strf_data = strf_file.readlines()
strf_data = strf_data[1:]
for i in range(len(strf_data)):
	strf_data[i] = strf_data[i].replace('\n','')
	strf_data[i] = strf_data[i].split(',')
	strf_data[i][1] = float(strf_data[i][1])
log.write('Reading Streamflow Data.\n\n')
print(a_par)
print (flow_par)




#	Inverse filter 를 사용한 BFI max 산정
for i in range(len(strf_data)-1,-1,-1):
	#	마지막 유량은 * 0.5
	if i == len(strf_data)-1:
		strf_data[i].append(strf_data[i][1]*0.5)
	else:
		#	Flood flow
		if strf_data[i][1] >= flow_par[0]:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[0] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[0],3))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

		#	high flow
		elif strf_data[i][1] >= flow_par[1] and strf_data[i][1] < flow_par[0]:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[1] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[1],3))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

		#	moderate flow
		elif strf_data[i][1] >= flow_par[2] and strf_data[i][1] < flow_par[1]:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[2] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[2],3))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

		#	low flow
		elif strf_data[i][1] >= flow_par[3] and strf_data[i][1] < flow_par[2]:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[3] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[3],3))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

		#	dry flow
		else:
			#	산정된 기저유량이 전일보다 작은 경우
			if strf_data[i+1][2]/a_par[4] < strf_data[i][1]:
				strf_data[i].append(round(strf_data[i+1][2]/a_par[4],3))
			#	산정된 기저유량이 전일 보다 클 경우
			else:
				strf_data[i].append(strf_data[i][1])

#	Inverse filter 결과를 활용하여 BFImax 산정
bfi = 0
strf = 0
for i in range(len(strf_data)):
	strf = strf+strf_data[i][1]
	bfi = bfi+strf_data[i][2]

bfimax = round(bfi/strf,3)
print ('')
print ("BFImax of Flow Regime is :: "+str(bfimax))

log.write('BFImax Calculation Done.\n')
log.write('BFImax is ::' + str(bfimax) + '\n')
log.write('===============================================\n\n')
log.close()

#	BFI max 계산결과 Web으로 반환
f = open('regime_a.csv','a')
f.write('BFImax,'+str(bfimax)+'\n')
f.close()