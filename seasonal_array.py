#	유량 자료를 기준으로 계절별 정렬하기
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
log.write('::: Seasonal Separation.\n')
log.write('\n')
log.write('\n')
log.write('\n')



# 업로드된 유량 자료 읽기
f = open('streamflow.csv','r')
data = f.readlines()

log.write('Load Streamflow Data from Server Successful.\n')

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


#	계절별 유량자료 정리
spr_f = open(path + 'spring.csv', 'w')
sum_f = open(path + 'summer.csv', 'w')
aut_f = open(path + 'autumn.csv', 'w')
win_f = open(path + 'winter.csv', 'w')
snl_flow_f = open(path + 'season_flow.csv', 'w')


#	월별로 구분해서 파일에 정리
for i in range(1,len(data)):
	#	spring
	if data[i][0].month in [3,4,5]:
		spr_f.write(str(data[i][0]) + ',' + str(data[i][1]) + '\n')
		snl_flow_f.write("SPRING," + str(data[i][1]) + '\n')

	#	summer
	elif data[i][0].month in [6,7,8]:
		sum_f.write(str(data[i][0]) + ',' + str(data[i][1]) + '\n')
		snl_flow_f.write("SUMMER," + str(data[i][1]) + '\n')

	#	autumn
	elif data[i][0].month in [9,10,11]:
		aut_f.write(str(data[i][0]) + ',' + str(data[i][1]) + '\n')
		snl_flow_f.write("AUTUMN," + str(data[i][1]) + '\n')

	#	winter
	else:# data[i][0].month in [12,1,2]:
		win_f.write(str(data[i][0]) + ',' + str(data[i][1]) + '\n')
		snl_flow_f.write("WINTER," + str(data[i][1]) + '\n')



#	파일 닫기 및 마무리
spr_f.close()
log.write('Spring season Streamflow Data Saved.\n')
sum_f.close()
log.write('Summer season Streamflow Data Saved.\n')
aut_f.close()
log.write('Autumn season Streamflow Data Saved.\n')
win_f.close()
log.write('Winter season Streamflow Data Saved.\n\n')
snl_flow_f.close()
log.write('Season flow data for Seasonal FDC Done.\n')
log.write('===============================================\n\n')

log.close()
