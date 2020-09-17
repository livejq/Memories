/* Note:Your choice is C IDE */
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <malloc.h>
#define MAXSIZE 20//所能存储学生信息的学生个体总数（或总数据条数）
#define ID 12//学号位数
#define MAXLEN 4//4表示名字的最大长度
#define KEY 'c'//密匙
#define HD printf("\t|       学号       |   姓名   |   英语   |   高数   |   计算机   |   平均分   |\n")
#define BT printf("\t|   %s   |   %s   |   %.2f   |   %.2f   |   %.2f   |   %.2f   |\n",p[x].sID,p[x].name,p[x].English,p[x].Math,p[x].Computer,p[x].Average)
#define UD printf("\t——————————————————————————————————————\n")
const char* filename="E:\\CYuYan\\grades_table.txt";//数据文件
const char* filename2="E:\\CYuYan\\password.txt";//密码文件
//定义一个指向文件路径的常量指针来声明文件路径！
//为了不让他人随意篡改数据，确保数据的准确性和完整性，在此设置了密码（非管理员不得进入！）
//初始密码为123456（六位）

typedef struct
{
	char sID[ID+1];//学号
	char name[MAXLEN*2+1];
	//中文占两个字节，并且要预留一个空间给结束符'\0'	
	float English;//英语成绩
	float Math;//高数成绩
	float Computer;//计算机成绩
	float Average;//三科平均分
}Student;

char *iInspectID(int count,Student *p)//输入并检查学号是否存在(与录入功能匹配)
{
	char num[ID+1],buffer[100];char *c;
	int i;
	printf("请输入学生的十二位学号:");
	while(1) {
		fflush(stdin);
		gets(buffer);
	if(strlen(buffer)!=12) {
		printf("输入错误！您输入的学号为空或不为十二位\n\n");
		printf("请重新输入：");
	}	
	else {
		strcpy(num,buffer);
		for(i=0;i<count;i++) {
			if(strcmp(num,p[i].sID)==0) {
			printf("此学号已存在！请重新输入:");
			break;
			}
		}
	}
		if(i==count) {
			c=(char*)malloc((strlen(num)+1));//
			strcpy(c,num);
			printf("学号合法！请继续向下执行！\n\n");
			break;
		}		
	}
	return c;
}

char *dInspectID(int count,Student *p)//输入并检查学号是否存在(与删除功能匹配)
{
	char num[ID+1],buffer[100];char *c;
	printf("请输入学生的十二位学号:");
	while(1) {
			fflush(stdin);
			gets(buffer);
		if(strlen(buffer)!=12) {
			printf("输入错误！您输入的学号为空或不为十二位\n\n");
			printf("请重新输入：");
			}	
		else {
			strcpy(num,buffer);
			c=(char*)malloc((strlen(num)+1));
			strcpy(c,num);
			printf("学号合法！请继续向下执行！\n\n");
			break;			
			}
	}
	return c;
}

int readDocument(Student *p)//读取文件信息
{
	int i=0,count=0;//一定要先初始化数据条数为0以防文件为空时遇到错误！
	FILE *fp=NULL;char c;
	if((fp=fopen(filename,"r"))==NULL) {
		fprintf(stderr,"can't open the file!\n");
		exit(1);
		}
 	else {
 			c=fgetc(fp);
 //一定得先将对文件判空写到读取文件代码的外面（得在此（while）之前进行判断）
		if(c==EOF) {
			printf("\t\t\t此文件内容为空！\n\n");
			}
 //feof()使用时应注意：如果用while在"前面"判断，
 		else {
 //当第一行遇到空值时则会出错（它是通过fread或fscanf的返回值来进行判断是否遇到错误）
 			rewind(fp);
 			while(!feof(fp)){
 				fscanf(fp,"%s%s%f%f%f",&p[i].sID,&p[i].name,&p[i].English,&p[i].Math,&p[i].Computer);
 					//应特别注意要传地址值！（非指针时只传字符数组的地址）
				p[i].Average=(p[i].English+p[i].Math+p[i].Computer)/3;
				i++;
 				 }
 		 		count=i;
 		}
 	}
	fclose(fp);
	return count;
}


void writeDocument(int count,Student *p)//将结构体中的数据存入文件
{
	int i=0;FILE *fp=NULL;
	if((fp=fopen(filename,"w"))==NULL) {
		fprintf(stderr,"can't open the file!\n");
		exit(1);
		}
 	else {
 		if(count==0) {//写入时也要判断数据是否为空，不然会写入垃圾数据
 			fclose(fp);
 			return;
 		} 
 		else
 			for(i=0;i<count;i++) {
 				fprintf(fp,"%s %s %.2f %.2f %.2f",p[i].sID,p[i].name,p[i].English,p[i].Math,p[i].Computer);
 		 		if(i!=count-1)
 		 		fprintf(fp,"\n");
 		 }
 	}
	fclose(fp);
}


int insertRecord(int count,Student *p)//录入学生信息
{	
	int i=0;char *arrays,nam[50];float e,m,c;
	
 		int k=0,sum=MAXSIZE;
 		printf("\n\t\t\t温馨提示：本系统最多可存储 %d 个学生的相关信息！\n\n\n",sum);
 		printf("您确定要录入学生成绩?");
 		printf("\t“确定”请输入“1”，任意字符键“取消”:");
 		scanf("%d",&k);
 		fflush(stdin);
 		if(k==1) {
 		arrays=iInspectID(count,p);
 		printf("请输入学生姓名：");
 		scanf("%s",&nam);
 		fflush(stdin);
 		printf("\n");
 		while(strlen(nam)>MAXLEN*2) {
 			printf("名字长度超过最大长度！请重新输入:");
 			scanf("%s",&nam);//不用gets（），因其能读入空格！
 			fflush(stdin);
 			printf("\n");
 		}	
 		printf("名字合法！请继续向下执行！\n\n");
 		printf("请输入英语成绩：");
 		scanf("%f",&e);
 		fflush(stdin);
 		printf("\n\n");
 		printf("请输入高数成绩：");
 		scanf("%f",&m);
 		fflush(stdin);
 		printf("\n\n");
 		printf("请输入计算机成绩：");
 		scanf("%f",&c);
 		fflush(stdin);
 		printf("\n\n");
 		strcpy(p[count].sID,arrays);
 		strcpy(p[count].name,nam);
 		p[count].English=e;
 		p[count].Math=m;
 		p[count].Computer=c;
 		p[count].Average=(e+m+c)/3;
 		printf("录入信息成功！\n\n");
 		system("PAUSE");
 		system("CLS");
 		}
 		else if(k==0) {
 			system("PAUSE");
 			system("CLS");
 		}
 		else {
 			system("PAUSE");
 			system("CLS");
 		} 
 	return ++count;
 }
 	


void modifyRecord(int count,Student *p)//修改学生信息记录
{	
	int k,d=0,y;char *arrays,nam[100];float e,m,c;
	char head[6][7]={"学号","姓名","英语","高数","计算机","平均分"};
 		
 		while(1) {
 			int i,j;
				arrays=dInspectID(count,p);
			for(i=0;i<count;i++) {
			if(strcmp(arrays,p[i].sID)==0) {
					for(j=0;j<6;j++)
	   				printf("%10s",head[j]);
	   				printf("\n");
	   				
					printf("%-15s",p[i].sID);
					printf("%-10s",p[i].name);
					printf("%.2f     ",p[i].English);
					printf("%.2f     ",p[i].Math);
					printf("%.2f     ",p[i].Computer);
					printf("%.2f     ",p[i].Average);
					printf("\n\n");
					printf("您确定要修改此学生的信息？\n");
					printf("“确定”请输入“1”，按任意字符键“取消”:");
					scanf("%d",&k);
					fflush(stdin);
				while(k==1) {
					int b=0;//给个初始值，使得按任意键时，即使是不能存入的字符，也可以退出修改！
					printf("            +++++-----------------++++\n");
					printf("            +--   1.修改姓名       --+\n");
					printf("            +--   2.修改英语成绩   --+\n");
					printf("            +--   3.修改高数成绩   --+\n");
					printf("            +--   4.修改计算机成绩 --+\n");
					printf("            +--   按任意字符键退出 --+\n");
   					printf("            +++++-----------------++++\n");
					printf("请选择您的操作：");
					scanf("%d",&b);
					fflush(stdin);
					if(b==1) {
						printf("请输入新学生姓名：");
 						scanf("%s",&nam);
				 		fflush(stdin);
				 		printf("\n");
				 		while(strlen(nam)>MAXLEN*2) {
				 			printf("名字长度超过最大长度！请重新输入:");
				 			scanf("%s",&nam);//不用gets（），因其能读入空格！
				 			fflush(stdin);
				 			printf("\n");
				 		}	
				 			strcpy(p[i].name,nam);
				 			j=2;
 							printf("名字修改成功！\n\n");
					}
					else if(b==2) {
							printf("请输入新英语成绩：");
			 				scanf("%f",&e);
			 				fflush(stdin);
 							printf("\n");
 							p[i].English=e;
 							j=2;
 							//在测试函数时发现每次修改一次成绩就得当即计算平均分
 							p[i].Average=(e+p[i].Math+p[i].Computer)/3;
 							printf("英语成绩修改成功！\n\n");
					}
					else if(b==3) {
							printf("请输入高数成绩：");
					 		scanf("%f",&m);
					 		fflush(stdin);
					 		printf("\n");
					 		p[i].Math=m;
					 		j=2;
					 		p[i].Average=(p[i].English+m+p[i].Computer)/3;
							printf("高数成绩修改成功！\n\n");
					}
					else if(b==4) {
							printf("请输入计算机成绩：");
					 		scanf("%f",&c);
					 		fflush(stdin);
					 		printf("\n");
					 		p[i].Computer=c;
					 		j=2;
					 		p[i].Average=(p[i].English+p[i].Math+c)/3;
							printf("计算机成绩修改成功！\n\n");
					}
					else if(b==0)
						break;
					else
						break; 
				} 
				if(k!=1)y=1;
				break;
			}
		}
		if(j==2) {
			printf("\n");
			printf("......已修改此学生的相关信息！\n\n");
			system("PAUSE");
			system("CLS");
			break;
		}
		else if(y==1) {
			printf("\n");
			printf("请慎重考虑后再来修改！\n\n");
			system("PAUSE");
			system("CLS");
			break;
		}
		else {
			printf("此学号不存在！请重新输入\n\n");
			d++;
			if(d==2) {//为了使操作更加人性化，规定了查找学号次数
			printf("或许您可以先查看一下所有学生信息！\n\n");
				system("PAUSE");
				system("CLS");
				break;
			}
			system("PAUSE");
			system("CLS");
		}
	
 	}
}


void searchRecord(int count,Student *p)//查询学生信息记录
{
	int i,j,k=0,b=0;char *arrays,name[MAXLEN*2+1],nam[100];
	int sum[MAXSIZE]={0};//记录查询到的数据的序号
	char head[6][7]={"学号","姓名","英语","高数","计算机","平均分"};
	
	while(1) {
			printf("按学号查询请输入“1” ,  按姓名查询请输入“2” , 按“0”键退出\n\n");
			printf("请选择：");
			scanf("%d",&k);
			fflush(stdin);
			if(k==1) {
				arrays=dInspectID(count,p);
			for(i=0;i<count;i++) {
			if(strcmp(arrays,p[i].sID)==0) {
					
					for(j=0;j<6;j++)
	   				printf("%10s",head[j]);
	   				printf("\n");
	   				 
					printf("%-15s",p[i].sID);
					printf("%-10s",p[i].name);
					printf("%.2f     ",p[i].English);
					printf("%.2f     ",p[i].Math);
					printf("%.2f     ",p[i].Computer);
					printf("%.2f     ",p[i].Average);
					printf("\n\n");
					break;//学号唯一，找到一条就退出循环！
				}
			}
			if(i==count) {
				printf("\n");
				printf("未能查询到与此学号相关的信息, 请确认无误后再重新查询！\n\n");
			}
			}
			else if(k==2) {
				printf("请输入学生姓名：");
		 		scanf("%s",nam);
		 		fflush(stdin);
		 		printf("\n");
		 		while(strlen(nam)>MAXLEN*2) {
		 			printf("名字长度超过最大长度！请重新输入:");
		 			scanf("%s",nam);//不用gets（），因其能读入空格！
		 			fflush(stdin);
		 			printf("\n");
 				}	
 					strcpy(name,nam);
 					for(i=0;i<count;i++) {
					if(strcmp(name,p[i].name)==0) {
						sum[b]=i;
						b++;
						//姓名不唯一，所以不能终止（每次都对所有数据进行遍历）
						}
 					}
 					
 				if(b==0) {
 					printf("\n");
					printf("未能查询到与此姓名相关的信息, 请确认无误后再重新查询！\n\n");
 				}	
 				else {
 					for(i=b-1;i>=0;i--) {
 						printf("\n\n在第 %d 条数据中存在此姓名！\n",sum[i]+1);
 						for(j=0;j<6;j++)
	   					printf("%10s",head[j]);
	   					printf("\n");
						printf("%-15s",p[sum[i]].sID);
						printf("%-10s",p[sum[i]].name);
						printf("%.2f     ",p[sum[i]].English);
						printf("%.2f     ",p[sum[i]].Math);
						printf("%.2f     ",p[sum[i]].Computer);
						printf("%.2f     ",p[sum[i]].Average);
						printf("\n\n");
 					}
 				}
			}
			else if(k==0) {
					system("PAUSE");
					system("CLS");
					break;
			}
			else {
				system("PAUSE");
				system("CLS");
				break;
			}
	}
}


int deleteRecord(int count,Student *p)//删除学生信息记录
{
	char *arrays;int i,j,k=0;int c,d=0,move;
	char head[6][7]={"学号","姓名","英语","高数","计算机","平均分"};
	
	c=count;
	while(1) {
		arrays=dInspectID(count,p);
	for(i=0;i<count;i++) {
	if(strcmp(arrays,p[i].sID)==0) {
		
		for(j=0;j<6;j++)
	   	printf("%10s",head[j]);
	   	printf("\n"); 
	   	
		printf("%-15s",p[i].sID);
		printf("%-10s",p[i].name);
		printf("%.2f     ",p[i].English);
		printf("%.2f     ",p[i].Math);
		printf("%.2f     ",p[i].Computer);
		printf("%.2f     ",p[i].Average);
		printf("\n\n");
		printf("您确定要删除此学生的所有信息？\n");
		printf("“确定”请输入“1”，按任意字符键“取消”:");
		scanf("%d",&k);
		fflush(stdin);
		if(k==1) {
			if(i==count-1) {
				--count;
				break;
			}
			else {
				move=count-(i+1);
			for (j=0;j<move;j++,i++) {
				p[i]=p[i+1];
				}
				--count;
				break;
			}
		}
		else if(k==0)
			break;
		else
			break;
	}
	}
		if(c!=count) {
			printf("\n");
			printf("......已删除此学生的所有信息！\n\n");
			system("PAUSE");
			system("CLS");
			break;
		}
		else if(i==count){	
			printf("此学号不存在！请重新输入\n\n");	
			d++;
			if(d==2) {//为了使操作更加人性化，规定了查找学号次数
				printf("或许您可以先查看一下所有学生信息！\n\n");
				system("PAUSE");
				system("CLS");
				break;
			}
			system("PAUSE");
			system("CLS");
		}
		else {
			printf("请慎重考虑后再来删除信息！\n\n");	
			system("PAUSE");
			system("CLS");
			break;
		}
	}
	return count;		
}
	


void seeAllMassage(int count,Student *p)//查看所有信息
{
	int x;
   	UD;HD;UD;
	for(x=0;x<count;x++) {
	BT;UD;
	}
	system("PAUSE");
	system("CLS");
}

void statistics(int count,Student *p)//统计查询功能
{
	int i,j;int undersix=0,six=0,seven=0,eight=0,nine=0,ten=0;float sum;
	char head[6][7]={"学号","姓名","英语","高数","计算机","平均分"};
	
	while(1) {
			int b=0;//给个初始值，使得按任意字符键时，即使是不能存入的字符，也可以退出修改！
				printf("\n\n\n");
				printf("            +++++---------------------------------++++\n");
		     	printf("            +--     1.三科成绩均大于85分的记录     --+\n");
				printf("            +--     2.有不及格课程的记录           --+\n");
				printf("            +--     3.平均分在指定范围的记录       --+\n");
				printf("            +--     4.平均分在各分数段的人数和比例 --+\n");
				printf("            +--          按任意字符键退出          --+\n");
		   	    printf("            +++++---------------------------------++++\n");
		     	printf("请选择您的操作：");
				scanf("%d",&b);
				fflush(stdin);
			if(b==1) {
				int k=0;
				for(i=0;i<count;i++) {
				if(p[i].English>85&&p[i].Math>85&&p[i].Computer>85) {
					for(j=0;j<6;j++)
					printf("%10s",head[j]);
					printf("\n"); 
					   	
					printf("%-15s",p[i].sID);
					printf("%-10s",p[i].name);
					printf("%.2f     ",p[i].English);
					printf("%.2f     ",p[i].Math);
					printf("%.2f     ",p[i].Computer);
					printf("%.2f     ",p[i].Average);
					k=1;
					printf("\n\n");
					}
				}
				if(k==0)
					printf("数据中未找到三科成绩均大于85分的记录！\n\n");
				system("PAUSE");
				system("CLS");
			}
			else if(b==2) {
					int k=0;
					for(i=0;i<count;i++) {
					if(p[i].English<60||p[i].Math<60||p[i].Computer<60) {
						for(j=0;j<6;j++)
						printf("%10s",head[j]);
						printf("\n"); 
						   	
						printf("%-15s",p[i].sID);
						printf("%-10s",p[i].name);
						printf("%.2f     ",p[i].English);
						printf("%.2f     ",p[i].Math);
						printf("%.2f     ",p[i].Computer);
						printf("%.2f     ",p[i].Average);
						k=1;
						printf("\n\n");
					}
				}
				if(k==0)
					printf("数据中未找到三科成绩中存在小于60分的记录！\n\n");
				system("PAUSE");
				system("CLS");			
			}
			else if(b==3) {
				float a,b;int k=0;
				printf("平均分的范围：[下限值,上限值], ps：包含端点值\n\n");
				printf("请输入平均分的下限值：");
				scanf("%f",&a);
				fflush(stdin);
				printf("\n");
				printf("请输入平均分的上限值：");
				scanf("%f",&b);
				fflush(stdin);
					for(i=0;i<count;i++) {
					if(a<=p[i].Average&&p[i].Average<=b) {
						for(j=0;j<6;j++)
						printf("%10s",head[j]);
						printf("\n"); 
						   	
						printf("%-15s",p[i].sID);
						printf("%-10s",p[i].name);
						printf("%.2f     ",p[i].English);
						printf("%.2f     ",p[i].Math);
						printf("%.2f     ",p[i].Computer);
						printf("%.2f     ",p[i].Average);
						k=1;
						printf("\n\n");
						}
					}
					if(k==0)
						printf("数据中未找到平均分在所给范围的记录！\n\n");
					system("PAUSE");
					system("CLS");					
			}
			else if(b==4) {
				printf("\n");
				printf("提示：60分以上10分为一个分数段，60分以下为一个分数段\n\n");
				for(i=0;i<count;i++) {
					if(p[i].Average<60) {
						undersix++;
					}
					else if(60<=p[i].Average&&p[i].Average<=69) {
						six++;
					}
					else if(70<=p[i].Average&&p[i].Average<=79) {
						seven++;
					}
					else if(80<=p[i].Average&&p[i].Average<=79) {
						eight++;
					}
					else if(90<=p[i].Average&&p[i].Average<=99) {
						nine++;
					}
					else if(p[i].Average==100) {
						ten++;
					}
				}
				printf("小于60分的人数为:%d\n",undersix);
				printf("[60-69]的人数为：%d\n",six);
				printf("[70-79]的人数为：%d\n",seven);
				printf("[80-89]的人数为：%d\n",eight);
				printf("[90-99]的人数为：%d\n",nine);	
				printf("等于100分的人数为：%d\n\n",ten);
				sum=(float)(undersix+six+seven+eight+nine+ten);
				printf("平均分在各个分数段的比例为：\n\n");
				printf(" <60  : [60-69] : [70-79] : [80-89] : [90-99] : =100\n\n");
				printf("%.2f%%  :   %.2f%%  :  %.2f%%   :  %.2f%%   :   %.2f%%  : %.2f%%\n\n",(undersix/sum)*100,(six/sum)*100,(seven/sum)*100,(eight/sum)*100,(nine/sum)*100,(ten/sum)*100);
				//分数或分母必须至少有一个是小数才能输出带小数的值！
				system("PAUSE");
				system("CLS");
			}
			else if(b==0) {
				system("PAUSE");
				system("CLS");
				break;
			}
			else {
				system("PAUSE");
				system("CLS");
				break;
			} 
	}
}


int encrypt()//加密算法，KEY为密匙
{
	FILE *fp=NULL;char w1[8],w2[8];int i,k=5;//可设置5次密码
	NEW:printf("请设置新密码(六位数字):");
			scanf("%6s",w1);//字符数组可不用地址符
			fflush(stdin);
			printf("\n\n");
			printf("请再次确认密码:");
			scanf("%6s",w2);//只取输入流中的前6位数
			fflush(stdin);
			k--;
		if(strcmp(w1,w2)==0&&strlen(w1)==6) {
			for(i=strlen(w2)-1;i>=0;i--) {//简单加密
				w2[i]+=KEY;
			}
			if((fp=fopen(filename2,"w"))==NULL) {
				fprintf(stdin,"设置失败！");
				fclose(fp);
				return 0;
			}
			else {
				fputs(w2,fp);
				printf("设置成功！\n\n");
				fclose(fp);
				return 1;	
			}
		}
		else {
			printf("设置失败！请再次输入\n\n");
			if(k!=0) {
				goto NEW;
			}
		}	
	return 0;
}

int decrypt(char word[8])//解密算法（若第一次使用则进行加密）,KEY为密匙
{
	FILE *fp=NULL;char w1[8],w2[8];int i=0,j=0;
	if((fp=fopen(filename2,"r"))==NULL) {
		FIRST:printf("请设置初始密码(六位数字):");
			scanf("%6s",w1);//字符数组可不用地址符
			fflush(stdin);
			printf("\n\n");
			printf("请再次确认密码:");
			scanf("%6s",w2);//只取输入流中的前6位数
			fflush(stdin);
		if(strcmp(w1,w2)==0&&strlen(w1)==6) {
			for(i=strlen(w2)-1;i>=0;i--) {//简单加密
				w2[i]+=KEY;
			}
			if(fp!=NULL)
			fclose(fp);
			if((fp=fopen(filename2,"w+"))==NULL) {
				fprintf(stderr,"设置失败!\n\n");
				fclose(fp);
				return 0;
			}
			else {
				fputs(w2,fp);
				fclose(fp);
				printf("设置成功！\n\n");
				return 2;	
			}
		}
		else {
			printf("设置失败！请再次输入\n\n");
			goto FIRST;
		}
		
	}
	else {
		while(!feof(fp)) {
			char c;
			c=fgetc(fp);
			if(c==EOF)break;
			rewind(fp);
			fscanf(fp,"%s",&w1);
			j++;
			}
		if(j!=0) {//文件不为空
			int k=6;//还有5次输入密码的机会
			for(i=strlen(w1)-1;i>=0;i--) {//解密
				w1[i]-=KEY;
			}
			while(k) {
				k--;//判断为真值后再减1次机会（这个额外的机会是从主函数里传进来的，所以k初始化为6）
				if(strcmp(w1,word)==0&&strlen(word)==6) {
					printf("\n\n\t\t密码正确,欢迎进入学生成绩管理系统！\n\n\n");
					fclose(fp);
				return 1;
				}
				else {
					printf("密码错误！请重新输入(剩余%d次)\n\n",k);
					scanf("%6s",word);
					fflush(stdin);
				}
			}
		}
		else {
			SECOND:printf("请设置初始密码(六位数字):");
			scanf("%6s",w1);//字符数组可不用地址符
			fflush(stdin);
			printf("\n\n");
			printf("请再次确认密码:");
			scanf("%6s",w2);//只取输入流中的前6位字符
			fflush(stdin);
		if(strcmp(w1,w2)==0&&strlen(w1)==6) {
			for(i=strlen(w2)-1;i>=0;i--) {//简单加密
				w2[i]+=KEY;
			}
			fclose(fp);
			if((fp=fopen(filename2,"w+"))==NULL) {
				fprintf(stdin,"设置失败！");
				fclose(fp);
				return 0;
			}
			else {
				fputs(w2,fp);
				printf("设置成功！\n\n");
				fclose(fp);
				return 2;	
			}
		}
		else {
			printf("设置失败！请再次输入\n\n");
			goto SECOND;
		}	
	}
	}
	printf("输入次数已用尽！\n\n");
	fclose(fp);
	return 0;
}

int menu()
{
	int i;
	printf("\n\n");
	printf("            +++++--------欢迎进入学生成绩管理系统-------+++++\n");
	printf("            +---------        1.读入文件           ---------+\n");
	printf("            +---------        2.录入学生信息       ---------+\n");
	printf("            +---------        3.修改学生成绩       ---------+\n");
	printf("            +---------        4.查询学生成绩       ---------+\n");
	printf("            +---------        5.删除学生成绩       ---------+\n");
	printf("            +---------        6.查看所有学生信息   ---------+\n");
	printf("            +---------        7.统计查询模块       ---------+\n");
	printf("            +---------        8.保存文件           ---------+\n");
	printf("            +---------        9.修改密码           ---------+\n");
	printf("            +---------        0.退出程序           ---------+\n");
   	printf("            +++++---------------------------------------+++++\n");
	printf("\n\t\t\t");
	do{
		printf("请输入【0-9】来执行操作：");
		scanf("%d",&i);
		fflush(stdin);
		if(i<0||i>9)
		printf("Error! The character is not able to be identified! Please input your number again!\n\n");
	}while(i<0||i>9);
	
	return i;
}

void main()
{
	int i=0,count;char password[8];int select=0;
	Student sall[MAXSIZE];
	Student *p;
	FILE *fop=NULL;
	p=sall;
	
	printf("password(6 bit):");
	scanf("%6s",password); //只取前六位数字字符
	
	if(decrypt(password)) {
	printf("正在读入文件信息......\n\n");
	count=readDocument(p);
 	printf("文件中的原始数据如下：\n\n");
 	seeAllMassage(count,p);
	i=menu();
	while(i!=0)
	{
		switch(i)
		{
		case 1:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<读入文件>>-----------------------\n\n");
    			count=readDocument(p);
    			printf("\n\t\t\t\t文件读取成功！\n\n");
    			system("PAUSE");
    			system("CLS");
    			break;
		case 2:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<录入信息>>-----------------------\n\n");
    			if(count!=MAXSIZE) {//确保数组不会越界（达到了最大的数据记录条数）
    				count=insertRecord(count,p);
    			}
    			else {
    				printf("\n\t\t\t\t已达到最大的数据记录条数！\n\n");
    				system("PAUSE");
    			}
    			break;
    	case 3:	system("CLS");
    			printf("\n\n");
				printf("\t\t-----------------------<<修改成绩>>-----------------------\n\n");
    			modifyRecord(count,p);
    			break;	
		case 4:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<查询成绩>>-----------------------\n\n");
    			searchRecord(count,p);
    			break;
		case 5:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<删除成绩>>-----------------------\n\n");
    			count=deleteRecord(count,p);
    			break;
    	case 6:	system("CLS");
    			printf("\n\n");
				printf("\t\t-----------------------<<查看所有信息>>-----------------------\n\n");
    			seeAllMassage(count,p);
    			break;
    	case 7:	system("CLS");
    			printf("\n\n");
				printf("\t-----------------------<<统计查询模块>>-----------------------\n\n");
    			statistics(count,p);
    			break;
    	case 8:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<保存文件>>-----------------------\n\n");
    			writeDocument(count,p);
    			printf("\n\t\t\t\t文件保存成功！\n\n");
    			system("PAUSE");
    			system("CLS");
    			break;
    	case 9:	system("CLS");
    			printf("\n\n");
				printf("\t\t-----------------------<<修改密码>>-----------------------\n\n");
    			encrypt();
    			break;					
    	default:break;
		}	
		i=menu();
	}
	printf("\n\t\t\t是否需要保存您所做的有关操作?\n");
	printf("\t\t\t确定请输入“1”,其它字符键取消：");
	scanf("%d",&select);
 	fflush(stdin);
 		if(select==1) {
 			writeDocument(count,p);
    		printf("\n\t\t\t\t文件保存成功！\n\n");
    		system("PAUSE");
 		}
	printf("\n\n");
	printf("\n\n\t\t\tSee you next time\n\n");
	}
	else {
		printf("\n\t\tGoodbye!\n\n");
	}
}