import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import os, sys



# 경로설정
IP = sys.argv[1]

# 경로설정
path = os.getcwd()+'/'
log_path = path+'input/'+IP+'/'
log = open(log_path+IP+'_sys_log.txt','a')



# 계절 그래프 만들기 위한 자료 작성하기
with open('season_flow.csv', 'r') as f:
	df = f.readlines()
df.remove(df[0])
for i in range(len(df)):
	df[i] = df[i].replace('\n','')
	df[i] = df[i].split(',')
	df[i][1] = float(df[i][1])
	
spring = []
summer = []
autumn = []
winter = []

for i in df:
    if 'SPRING' in i:
        spring.append(i[1])
    elif 'SUMMER' in i:
        summer.append(i[1])
    elif 'AUTUMN' in i:
        autumn.append(i[1])
    else:
        winter.append(i[1])

spring = np.array(spring)
summer = np.array(summer)
autumn = np.array(autumn)
winter = np.array(winter)


plt.figure(figsize=(7, 5))
plt.boxplot((spring,summer,autumn,winter))
plt.grid()
plt.title('Seasonal FDC Graph')
plt.yscale('log')
plt.ylabel("Streamflow (Log CMS)")
plt.xlabel('Seasons')
positions = (1, 2, 3, 4)
labels = ('SPRING','SUMMER','AUTUMN','WINTER')
plt.xticks(positions, labels)
plt.savefig('SNL_FDC_graph.png', dpi=300)
plt.show()

# 계절 그래프 만들기 종료
log.write('Seasonal FDC Graph Exported.\n')













def FDC_work(f):
	global exist, FDC
	# 업로드된 유량 자료 읽기
	data = f.readlines()

	#	날짜와 유량자료 형태 변환
	for i in range(1,len(data)):
		data[i] = data[i].replace('\n','')
		data[i] = data[i].split(',')
		data[i][0] = data[i][0].split('-')
		
		#	날짜 정규식으로 변환
		for r in range(len(data[i][0])):
			data[i][0][r] = int(data[i][0][r])
		

		#	유량자료 실수로 변환
		data[i][1] = round(float(data[i][1]),3)


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
		temp.append((FDC[i], exist[i] / len(data) * 100))

	#	유량 크기순으로 정렬
	FDCtuple = sorted(temp, key=lambda x: (-x[0]))


	#	튜플을 리스트로 변경
	FDClist = []
	for i in range(len(FDCtuple)):
		FDClist.append(list(FDCtuple[i]))

	#	FDC 재현 빈도 누적으로 변경하기
	for i in range(1,len(FDClist)):
		FDClist[i][1] = round(FDClist[i][1]+FDClist[i-1][1],3)
	
	FDC = []
	exist = []
	for i in range(len(FDClist)):
		FDC.append(FDClist[i][0])
		exist.append(FDClist[i][1])

f = open('streamflow.csv','r')
FDC_work(f)


#	FDC 그래프 플로팅
plt.figure(figsize=(7,5))
plt.title('FDC Graph')
plt.yscale('log')
plt.xlabel("Flow Exceedance(%)")
plt.xlim(0,100)
plt.xticks([0,10,40,60,90,100])
plt.ylabel("Streamflow (Log CMS)")
plt.grid()
plt.plot(exist,FDC,color='blue')
plt.savefig('FDC_graph.png', dpi=300)
plt.show()


log.write('FDC Graph Exported.\n')








# Seasonal FDC Making
snl_files = ['spring.csv', 'summer.csv', 'autumn.csv', 'winter.csv']
# fig.set_figheight(5)
# fig.set_figwidth(5)
plt.figure(figsize=(14,5))

for i in range(len(snl_files)):
	try:
		f = open(snl_files[i], 'r')
	except:
		print('Failed opening ',snl_files[i])
	FDC_work(f)
	plt.plot(exist,FDC, linewidth=2)

plt.yscale('log')
plt.xlabel("Flow Exceedance(%)")
plt.xlim(0,100)
plt.xticks([0,10,40,60,90,100])
plt.ylabel("Streamflow (Log CMS)")
plt.legend(['SPRING','SUMMER','AUTUMN','WINTER'])
plt.grid()
plt.savefig('SNLB_graph.png', dpi=300)
plt.show()