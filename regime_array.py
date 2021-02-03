#유량 자료를 기준으로 유황별 정렬하기
from datetime import date
from matplotlib import pyplot as plt
import os, sys



# 경로설정
IP = sys.argv[1]

# 경로설정
path = os.getcwd()+'/'
log_path = path+'input/'+IP+'/'
log = open(log_path+IP+'_sys_log.txt','a')

log.write('Whatever First Below Here Is The Separation Method You Choose.\n')
log.write('::: Flow Duration Separation.\n')
log.write('\n')
log.write('\n')
log.write('\n')



log.write('Load Streamflow Data from Server Successful.\n')



#	사용자가 업로드한 이름으로 변경 필요 ******
f = open(path+'/streamflow.csv','r')
data = f.readlines()


#	날짜와 유량자료 형태 변환
for i in range(1,len(data)):
	data[i] = data[i].replace('\n','')
	data[i] = data[i].split(',')
	data[i][0] = data[i][0].split('-')
	
	#	날짜 정규식으로 변환
	for r in range(len(data[i][0])):
		data[i][0][r] = int(data[i][0][r])
	
	#	날짜 데이터로 정리
	data[i][0] = date(data[i][0][0],data[i][0][1],data[i][0][2])
	#	유량자료 실수로 변환
	data[i][1] = round(float(data[i][1]),3)

log.write('Streamflow Data Conversion Done.\n\n')


#	FDC 리스트 정리
FDC = []
exist = []
for i in range(1,len(data)):
	if data[i][1] not in FDC:
		FDC.append(data[i][1])
		exist.append(1)
	else:
		exist[FDC.index(data[i][1])] = exist[FDC.index(data[i][1])]+1


#	FDC 값 만들어주기 // list로 작성할 경우 sorting에 어려움이 있어서 tuple로 작성 후 list로 변경
temp = []
for i in range(len(FDC)):
	temp.append((FDC[i],exist[i]/len(data)*100))

#	유량 크기순으로 정렬
FDCtuple = sorted(temp, key = lambda x : (-x[0]))

#	튜플을 리스트로 변경
FDClist = []
for i in range(len(FDCtuple)):
	FDClist.append(list(FDCtuple[i]))

#FDC 재현 빈도 누적으로 변경하기
for i in range(1,len(FDClist)):
	FDClist[i][1] = round(FDClist[i][1]+FDClist[i-1][1],3)

FDC = []
exist = []
for i in range(len(FDClist)):
	FDC.append(FDClist[i][0])
	exist.append(FDClist[i][1])



#	FDC를 기반으로 75%, 50%, 25%로 기준이 되는 유량 파악하기
flow_criteria = []
for i in [10, 40, 60, 90]:
	a = []
	for r in range(len(exist)):
		a.append(abs(i-exist[r]))
	flow_criteria.append(FDC[a.index(min(a))])

print(flow_criteria)

#	유황별 유량자료 정리
flood_f = open(path+'/flood.csv','w')
high_f = open(path+'/high.csv','w')
moderate_f = open(path+'/moderate.csv','w')
low_f = open(path+'/low.csv','w')
dry_f = open(path+'/dry.csv','w')

#	유황별로 구분해서 파일에 정리
for i in range(1,len(data)):
	#	flood flow
	if data[i][1] >= flow_criteria[0]:
		flood_f.write(str(data[i][0])+','+str(data[i][1])+'\n')
	#	high flow
	elif data[i][1] >= flow_criteria[1] and data[i][1] < flow_criteria[0]:
		high_f.write(str(data[i][0])+','+str(data[i][1])+'\n')
	#	moderate flow
	elif data[i][1] >= flow_criteria[2] and data[i][1] < flow_criteria[1]:
		moderate_f.write(str(data[i][0])+','+str(data[i][1])+'\n')
	#	low flow
	elif data[i][1] >= flow_criteria[3] and data[i][1] < flow_criteria[2]:
		low_f.write(str(data[i][0])+','+str(data[i][1])+'\n')
	#	dry flow
	else:
		dry_f.write(str(data[i][0])+','+str(data[i][1])+'\n')

#	유황별 기준 유량 파일로 저장
result = open(path+'/regime_a.csv','w')
result.write('Flow Duration Range\n')
result.write('Regime,MIN,MAX\n')
result.write('Flood,' + str(flow_criteria[0]) + ',\n')
result.write('High,' + str(flow_criteria[1]) + ',' + str(flow_criteria[0]) + '\n')
result.write('Moderate,' + str(flow_criteria[2]) + ',' + str(flow_criteria[1]) + '\n')
result.write('Low,' + str(flow_criteria[3]) + ',' + str(flow_criteria[2]) + '\n')
result.write('Dry,,'+str(flow_criteria[3]) + '\n')




for i in range(len(flow_criteria)):
	result.write(str(flow_criteria[i])+',')

result.write('\n')
result.close()


#	파일 닫기 및 마무리

flood_f.close()
log.write('Flood Flow Duration Streamflow Data Saved.\n')
high_f.close()
log.write('High Flow Duration Streamflow Data Saved.\n')
moderate_f.close()
log.write('Moderate Flow Duration Streamflow Data Saved.\n')
low_f.close()
log.write('Low Flow Duration Streamflow Data Saved.\n')
dry_f.close()
log.write('Dry Flow Duration Streamflow Data Saved.\n')
log.write('Flow Duration data for FDC Done.\n')
log.write('===============================================\n\n')

log.close()