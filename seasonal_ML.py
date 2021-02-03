import os, sys
from datetime import date, timedelta
from numpy import array, nan
from copy import deepcopy
import math
import tensorflow as tf

# 경로설정
IP = sys.argv[1]

# 경로설정
path = os.getcwd()+'/'
log_path = path+'input/'+IP+'/'
log = open(log_path+IP+'_sys_log.txt','a')


#이전 단계에서 기준별로 분류된 유량파일 읽어오기
try:
	spring_f = open('spring.csv', 'r')
except:
	log.write('Spring.csv File Open Failed.\n')
spring_d = spring_f.readlines()
spring_f.close()

try:
	summer_f = open('summer.csv', 'r')
except:
	log.write('Summer.csv File Open Failed.\n')
summer_d = summer_f.readlines()
summer_f.close()

try:
	autumn_f = open('autumn.csv', 'r')
except:
	log.write('Autumn.csv File Open Failed.\n')
autumn_d = autumn_f.readlines()
autumn_f.close()

try:
	winter_f = open('winter.csv', 'r')
except:
	log.write('Winter.csv File Open Failed.\n')
winter_d = winter_f.readlines()
winter_f.close()

log.write('Streamflow Data of Four Seasons are recognized.\n')


#	날짜와 유량자료 형태 변환
d_list = [spring_d, summer_d, autumn_d, winter_d]
seasons = ['Spring','Summer','Autumn','Winter']
a_par_list = []
process = 0

for i in d_list:
	for r in range(len(i)):
		i[r] = i[r].replace('\n','')
		i[r] = i[r].split(',')
		i[r][0] = i[r][0].split('-')

		#날짜 정규식으로 변환
		for k in range(len(i[r][0])):
			i[r][0][k] = int(i[r][0][k])

		#	날짜 데이터로 정리
		i[r][0] = date(i[r][0][0],i[r][0][1],i[r][0][2])
		#	유량자료 실수로 변환
		i[r][1] = round(float(i[r][1]),3)
log.write('Streamflow Data Conversion for Machine Learning Done.\n\n')


for k in d_list:
	#	감수부 추출
	#	최저 감수일은 4일로 설정한다. 4일 이하의 감수는 무시
	def rec_curve_extr(k):
	    global rec
	    rec = []
	    rec_days = []
	    lines_dummy = deepcopy(k)
		#	개별 감수부 추가 리스트   
	    temp = []

	    #	일자순서대로 읽어오기
	    for r in range(len(lines_dummy) - 1):
	    	#	유황자료는 일자가 이어지지 않으므로 일연속성에 대한 조건을 추가함
	    	#	계절자료는 일자가 이어지므로 일연속성에 대한 조건이 필요 없음
	    	#	전일 유량이 다음날 보다 크고
	        if lines_dummy[r][1] > lines_dummy[r + 1][1]:
	            #감수부 리스트에 추가
	            temp.append(lines_dummy[r])

	        #	유량이 기준일 다음날 증가하거나 일자가 연속적이지 않게되면,
	        else:
	            if len(temp) > 3 and len(temp) < 51:
	                if lines_dummy[r - 1][1] > lines_dummy[r][1]:
	                    temp.append(lines_dummy[r])
	                rec.append(temp)
	                rec_days.append(len(temp))
	                temp = []

	            else:
	                temp = []

	#	감수부 일자 정리하기
	def rec_day_initializer():
	    global rec
	    for i in range(len(rec)):

	        for k in range(len(rec[i])):
	            rec[i][k][0] = k

	def rec_rearranger():
	    global rec

	    def peakflow(rec):
	        return rec[:][0][1]

	    rec = sorted(rec, reverse=True, key=peakflow)
	    rec = array(rec)

	#	Matching Strip Method를 통해서 MRC를 산정하기 위한 감수부 나열
	def matching_strip_method():
	    global rec
	    
	    storage=[]
	    
	    for i in range(1,len(rec)): #추출된 감수부 수 만큼     
	        for k in range(len(rec[i-1])): #추가된 모든 감수부와 비교 후 유량 확인
	            temp=abs(rec[i][0][1]-rec[i-1][k][1])
	            storage.append(temp)
	        
	        a=rec[i-1][storage.index(min(storage))][0]
	        storage=[]
	        temp=[]
	        
	        for k in range(len(rec[i])):
	            rec[i][k][0]=rec[i][k][0]+a

	#	기계학습을 위한 함수
	def Learning_data_makeup():
	    global x_data, y_data, learning_data
	    learning_data=[[],[]]
	    
	    for i in range(len(rec)):    
	        for k in range(len(rec[i])):
	            learning_data[0].append(float(rec[i][k][0]))
	            learning_data[1].append(math.log10(rec[i][k][1]))
	    
	    x_data=learning_data[0]
	    y_data=learning_data[1]

	#	경사하감법을 통하여 MRC를 산정
	def MRC_ML():
	    global gradient, b_value, process
	    W=tf.Variable(tf.random.uniform([1],-1.0,1.0))
	    b=tf.Variable(tf.zeros([1]))
	    y=W*x_data+b
	    rate=0.0002
	    #	반복 횟수 250,000회로 감소
	    #	반복 횟수 200,000회로 감소
	    #	반복 횟수 150,000회로 감소
	    Rep=150000
	    
	    loss=tf.reduce_mean(tf.square(y-y_data))
	    train=tf.train.GradientDescentOptimizer(rate).minimize(loss)

	    init=tf.global_variables_initializer()
	    sess=tf.Session()
	    sess.run(init)
	    print('MRC being adjusted'.center(60,'='))
	    print('This process takes about a minute...')
	    print("Learning status".center(80))
	    print('Learning rate :',rate,'  Rep :',Rep)
	    print('Started from, loss: ', sess.run(loss),' W: ', sess.run(W), 'b_value: ',sess.run(b))
	    print('')
	    ML_pvalue = 0
	    for step in range(Rep+1):
	        sess.run(train)        
	        if step%75000==0 and step != 0:
	            #print (step,'th / ', sess.run(loss),' / ', sess.run(W),' / ', sess.run(b))
	            gradient=sess.run(W)
	            b_value=sess.run(b)
	            ML_pvalue = ML_pvalue + 10
	            process = process + 10
	            print ('Process :: ', process, '%')
	            if process == 100:
	            	print ('Machine Learning process completed!')
	    print("DONE".center(80, ' '))
	    print(''.center(80,'='))
	    print("")
	    print ("Optimization finished Successfully".center(80))
	    print ("Best MRC formula below :".center(80))
	    print ('10**(',gradient,'*(recession days) +',b_value,')')

	#	MRC 파악
	#	Log형 MRC와 자연수형 MRC를 그리는 함수
	def make_MRC():
	    global MRC, MRC_log, gradient
	    MRC=[]
	    MRC_log=[]
	    for i in range(int(min(x_data)), int(max(x_data)),1):
	        MRC_log.append([i, gradient*i+b_value]) ############Log형 MRC
	    
	    MRC_log=array(MRC)
	    
	    for i in range(int(0), int(150),1):
	        MRC.append([i,pow(10,gradient*i+b_value)]) #########자연수 형 MRC
	    
	    MRC=array(MRC)

	#	a parameter 파악
	def a_par():
	    global a, a_par_list
	    #	Recession constant 'a' from MRC
	    a=MRC[1][1]/MRC[0][1]
	    #print(a)
	    a=round(a[0],3)
	    #print ('a parameter(From MRC) is : ',a)
	    a_par_list.append(a)
	
	log.write(seasons[d_list.index(k)]+'\n')
	rec_curve_extr(k)
	log.write('==> Rcession Curve Extraction Success.\n')
	rec_day_initializer()
	log.write('==> Recession Days Calculated.\n')
	rec_rearranger()
	log.write('==> Recession Curve Rearrangement Done.\n')

	matching_strip_method()
	log.write('==> Master Recession Curve for a Parameter Calculated.\n')
	Learning_data_makeup()
	MRC_ML()
	log.write('==> Machine Learning Conducted.\n\n')
	make_MRC()
	a_par()

print('')
print ('a parameters are following...')
print ('Spring :: ', a_par_list[0])
print ('Summer :: ', a_par_list[1])
print ('Autumn :: ', a_par_list[2])
print ('Winter :: ', a_par_list[3])

log.write('a Parameters Are Following Below ::\n')
log.write('Spring,'+str(a_par_list[0])+'\n')
log.write('Summer,'+str(a_par_list[1])+'\n')
log.write('Autumn,'+str(a_par_list[2])+'\n')
log.write('Winter,'+str(a_par_list[3])+'\n')
log.write('===============================================\n\n')
log.close()

#	a parameter 파일 생성
result = open('seasonal_a.csv','w')
result.write('Spring,'+str(a_par_list[0])+'\n')
result.write('Summer,'+str(a_par_list[1])+'\n')
result.write('Autumn,'+str(a_par_list[2])+'\n')
result.write('Winter,'+str(a_par_list[3])+'\n')
result.close()

#	MRC 그래프 표현 및 그래프 그림 저장