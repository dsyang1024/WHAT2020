import os, shutil, sys, datetime

# php에서 아이피주소 변수로 받아오기
IP = sys.argv[1]

# 경로설정
path = os.getcwd()+'/'
engine_path = path+'/engine/'
ip_path = path+'/input/'+IP+'/'

# 검증단계
log = open(ip_path+IP+'_sys_log.txt','w')

log.write(str(datetime.datetime.now())+'\n')
log.write('CWD :: '+path+'\n')
log.write('USER IP :: '+IP+'\n\n')
# 경로내 엔진파일 추려내기
file_list = os.listdir(engine_path)
try:
    log.write('Engine Path :: '+engine_path.upper()+'\n\n')
except:
    log.write('Engine Path Not Found\n')


engines = [file for file in file_list if file.endswith('.py')]
log.write('== Engines List =='+'\n')
for i in engines:
    log.write(str(engines.index(i) + 1) + '. ' + i.upper() + '\n')
    
log.write('File Copying to Directory...\n')
    
log.write('===============================================\n\n')
log.close()