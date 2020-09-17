/* Note:Your choice is C IDE */
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <malloc.h>
#define MAXSIZE 20//���ܴ洢ѧ����Ϣ��ѧ��������������������������
#define ID 12//ѧ��λ��
#define MAXLEN 4//4��ʾ���ֵ���󳤶�
#define KEY 'c'//�ܳ�
#define HD printf("\t|       ѧ��       |   ����   |   Ӣ��   |   ����   |   �����   |   ƽ����   |\n")
#define BT printf("\t|   %s   |   %s   |   %.2f   |   %.2f   |   %.2f   |   %.2f   |\n",p[x].sID,p[x].name,p[x].English,p[x].Math,p[x].Computer,p[x].Average)
#define UD printf("\t����������������������������������������������������������������������������\n")
const char* filename="E:\\CYuYan\\grades_table.txt";//�����ļ�
const char* filename2="E:\\CYuYan\\password.txt";//�����ļ�
//����һ��ָ���ļ�·���ĳ���ָ���������ļ�·����
//Ϊ�˲�����������۸����ݣ�ȷ�����ݵ�׼ȷ�Ժ������ԣ��ڴ����������루�ǹ���Ա���ý��룡��
//��ʼ����Ϊ123456����λ��

typedef struct
{
	char sID[ID+1];//ѧ��
	char name[MAXLEN*2+1];
	//����ռ�����ֽڣ�����ҪԤ��һ���ռ��������'\0'	
	float English;//Ӣ��ɼ�
	float Math;//�����ɼ�
	float Computer;//������ɼ�
	float Average;//����ƽ����
}Student;

char *iInspectID(int count,Student *p)//���벢���ѧ���Ƿ����(��¼�빦��ƥ��)
{
	char num[ID+1],buffer[100];char *c;
	int i;
	printf("������ѧ����ʮ��λѧ��:");
	while(1) {
		fflush(stdin);
		gets(buffer);
	if(strlen(buffer)!=12) {
		printf("��������������ѧ��Ϊ�ջ�Ϊʮ��λ\n\n");
		printf("���������룺");
	}	
	else {
		strcpy(num,buffer);
		for(i=0;i<count;i++) {
			if(strcmp(num,p[i].sID)==0) {
			printf("��ѧ���Ѵ��ڣ�����������:");
			break;
			}
		}
	}
		if(i==count) {
			c=(char*)malloc((strlen(num)+1));//
			strcpy(c,num);
			printf("ѧ�źϷ������������ִ�У�\n\n");
			break;
		}		
	}
	return c;
}

char *dInspectID(int count,Student *p)//���벢���ѧ���Ƿ����(��ɾ������ƥ��)
{
	char num[ID+1],buffer[100];char *c;
	printf("������ѧ����ʮ��λѧ��:");
	while(1) {
			fflush(stdin);
			gets(buffer);
		if(strlen(buffer)!=12) {
			printf("��������������ѧ��Ϊ�ջ�Ϊʮ��λ\n\n");
			printf("���������룺");
			}	
		else {
			strcpy(num,buffer);
			c=(char*)malloc((strlen(num)+1));
			strcpy(c,num);
			printf("ѧ�źϷ������������ִ�У�\n\n");
			break;			
			}
	}
	return c;
}

int readDocument(Student *p)//��ȡ�ļ���Ϣ
{
	int i=0,count=0;//һ��Ҫ�ȳ�ʼ����������Ϊ0�Է��ļ�Ϊ��ʱ��������
	FILE *fp=NULL;char c;
	if((fp=fopen(filename,"r"))==NULL) {
		fprintf(stderr,"can't open the file!\n");
		exit(1);
		}
 	else {
 			c=fgetc(fp);
 //һ�����Ƚ����ļ��п�д����ȡ�ļ���������棨���ڴˣ�while��֮ǰ�����жϣ�
		if(c==EOF) {
			printf("\t\t\t���ļ�����Ϊ�գ�\n\n");
			}
 //feof()ʹ��ʱӦע�⣺�����while��"ǰ��"�жϣ�
 		else {
 //����һ��������ֵʱ����������ͨ��fread��fscanf�ķ���ֵ�������ж��Ƿ���������
 			rewind(fp);
 			while(!feof(fp)){
 				fscanf(fp,"%s%s%f%f%f",&p[i].sID,&p[i].name,&p[i].English,&p[i].Math,&p[i].Computer);
 					//Ӧ�ر�ע��Ҫ����ֵַ������ָ��ʱֻ���ַ�����ĵ�ַ��
				p[i].Average=(p[i].English+p[i].Math+p[i].Computer)/3;
				i++;
 				 }
 		 		count=i;
 		}
 	}
	fclose(fp);
	return count;
}


void writeDocument(int count,Student *p)//���ṹ���е����ݴ����ļ�
{
	int i=0;FILE *fp=NULL;
	if((fp=fopen(filename,"w"))==NULL) {
		fprintf(stderr,"can't open the file!\n");
		exit(1);
		}
 	else {
 		if(count==0) {//д��ʱҲҪ�ж������Ƿ�Ϊ�գ���Ȼ��д����������
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


int insertRecord(int count,Student *p)//¼��ѧ����Ϣ
{	
	int i=0;char *arrays,nam[50];float e,m,c;
	
 		int k=0,sum=MAXSIZE;
 		printf("\n\t\t\t��ܰ��ʾ����ϵͳ���ɴ洢 %d ��ѧ���������Ϣ��\n\n\n",sum);
 		printf("��ȷ��Ҫ¼��ѧ���ɼ�?");
 		printf("\t��ȷ���������롰1���������ַ�����ȡ����:");
 		scanf("%d",&k);
 		fflush(stdin);
 		if(k==1) {
 		arrays=iInspectID(count,p);
 		printf("������ѧ��������");
 		scanf("%s",&nam);
 		fflush(stdin);
 		printf("\n");
 		while(strlen(nam)>MAXLEN*2) {
 			printf("���ֳ��ȳ�����󳤶ȣ�����������:");
 			scanf("%s",&nam);//����gets�����������ܶ���ո�
 			fflush(stdin);
 			printf("\n");
 		}	
 		printf("���ֺϷ������������ִ�У�\n\n");
 		printf("������Ӣ��ɼ���");
 		scanf("%f",&e);
 		fflush(stdin);
 		printf("\n\n");
 		printf("����������ɼ���");
 		scanf("%f",&m);
 		fflush(stdin);
 		printf("\n\n");
 		printf("�����������ɼ���");
 		scanf("%f",&c);
 		fflush(stdin);
 		printf("\n\n");
 		strcpy(p[count].sID,arrays);
 		strcpy(p[count].name,nam);
 		p[count].English=e;
 		p[count].Math=m;
 		p[count].Computer=c;
 		p[count].Average=(e+m+c)/3;
 		printf("¼����Ϣ�ɹ���\n\n");
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
 	


void modifyRecord(int count,Student *p)//�޸�ѧ����Ϣ��¼
{	
	int k,d=0,y;char *arrays,nam[100];float e,m,c;
	char head[6][7]={"ѧ��","����","Ӣ��","����","�����","ƽ����"};
 		
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
					printf("��ȷ��Ҫ�޸Ĵ�ѧ������Ϣ��\n");
					printf("��ȷ���������롰1�����������ַ�����ȡ����:");
					scanf("%d",&k);
					fflush(stdin);
				while(k==1) {
					int b=0;//������ʼֵ��ʹ�ð������ʱ����ʹ�ǲ��ܴ�����ַ���Ҳ�����˳��޸ģ�
					printf("            +++++-----------------++++\n");
					printf("            +--   1.�޸�����       --+\n");
					printf("            +--   2.�޸�Ӣ��ɼ�   --+\n");
					printf("            +--   3.�޸ĸ����ɼ�   --+\n");
					printf("            +--   4.�޸ļ�����ɼ� --+\n");
					printf("            +--   �������ַ����˳� --+\n");
   					printf("            +++++-----------------++++\n");
					printf("��ѡ�����Ĳ�����");
					scanf("%d",&b);
					fflush(stdin);
					if(b==1) {
						printf("��������ѧ��������");
 						scanf("%s",&nam);
				 		fflush(stdin);
				 		printf("\n");
				 		while(strlen(nam)>MAXLEN*2) {
				 			printf("���ֳ��ȳ�����󳤶ȣ�����������:");
				 			scanf("%s",&nam);//����gets�����������ܶ���ո�
				 			fflush(stdin);
				 			printf("\n");
				 		}	
				 			strcpy(p[i].name,nam);
				 			j=2;
 							printf("�����޸ĳɹ���\n\n");
					}
					else if(b==2) {
							printf("��������Ӣ��ɼ���");
			 				scanf("%f",&e);
			 				fflush(stdin);
 							printf("\n");
 							p[i].English=e;
 							j=2;
 							//�ڲ��Ժ���ʱ����ÿ���޸�һ�γɼ��͵õ�������ƽ����
 							p[i].Average=(e+p[i].Math+p[i].Computer)/3;
 							printf("Ӣ��ɼ��޸ĳɹ���\n\n");
					}
					else if(b==3) {
							printf("����������ɼ���");
					 		scanf("%f",&m);
					 		fflush(stdin);
					 		printf("\n");
					 		p[i].Math=m;
					 		j=2;
					 		p[i].Average=(p[i].English+m+p[i].Computer)/3;
							printf("�����ɼ��޸ĳɹ���\n\n");
					}
					else if(b==4) {
							printf("�����������ɼ���");
					 		scanf("%f",&c);
					 		fflush(stdin);
					 		printf("\n");
					 		p[i].Computer=c;
					 		j=2;
					 		p[i].Average=(p[i].English+p[i].Math+c)/3;
							printf("������ɼ��޸ĳɹ���\n\n");
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
			printf("......���޸Ĵ�ѧ���������Ϣ��\n\n");
			system("PAUSE");
			system("CLS");
			break;
		}
		else if(y==1) {
			printf("\n");
			printf("�����ؿ��Ǻ������޸ģ�\n\n");
			system("PAUSE");
			system("CLS");
			break;
		}
		else {
			printf("��ѧ�Ų����ڣ�����������\n\n");
			d++;
			if(d==2) {//Ϊ��ʹ�����������Ի����涨�˲���ѧ�Ŵ���
			printf("�����������Ȳ鿴һ������ѧ����Ϣ��\n\n");
				system("PAUSE");
				system("CLS");
				break;
			}
			system("PAUSE");
			system("CLS");
		}
	
 	}
}


void searchRecord(int count,Student *p)//��ѯѧ����Ϣ��¼
{
	int i,j,k=0,b=0;char *arrays,name[MAXLEN*2+1],nam[100];
	int sum[MAXSIZE]={0};//��¼��ѯ�������ݵ����
	char head[6][7]={"ѧ��","����","Ӣ��","����","�����","ƽ����"};
	
	while(1) {
			printf("��ѧ�Ų�ѯ�����롰1�� ,  ��������ѯ�����롰2�� , ����0�����˳�\n\n");
			printf("��ѡ��");
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
					break;//ѧ��Ψһ���ҵ�һ�����˳�ѭ����
				}
			}
			if(i==count) {
				printf("\n");
				printf("δ�ܲ�ѯ�����ѧ����ص���Ϣ, ��ȷ������������²�ѯ��\n\n");
			}
			}
			else if(k==2) {
				printf("������ѧ��������");
		 		scanf("%s",nam);
		 		fflush(stdin);
		 		printf("\n");
		 		while(strlen(nam)>MAXLEN*2) {
		 			printf("���ֳ��ȳ�����󳤶ȣ�����������:");
		 			scanf("%s",nam);//����gets�����������ܶ���ո�
		 			fflush(stdin);
		 			printf("\n");
 				}	
 					strcpy(name,nam);
 					for(i=0;i<count;i++) {
					if(strcmp(name,p[i].name)==0) {
						sum[b]=i;
						b++;
						//������Ψһ�����Բ�����ֹ��ÿ�ζ����������ݽ��б�����
						}
 					}
 					
 				if(b==0) {
 					printf("\n");
					printf("δ�ܲ�ѯ�����������ص���Ϣ, ��ȷ������������²�ѯ��\n\n");
 				}	
 				else {
 					for(i=b-1;i>=0;i--) {
 						printf("\n\n�ڵ� %d �������д��ڴ�������\n",sum[i]+1);
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


int deleteRecord(int count,Student *p)//ɾ��ѧ����Ϣ��¼
{
	char *arrays;int i,j,k=0;int c,d=0,move;
	char head[6][7]={"ѧ��","����","Ӣ��","����","�����","ƽ����"};
	
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
		printf("��ȷ��Ҫɾ����ѧ����������Ϣ��\n");
		printf("��ȷ���������롰1�����������ַ�����ȡ����:");
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
			printf("......��ɾ����ѧ����������Ϣ��\n\n");
			system("PAUSE");
			system("CLS");
			break;
		}
		else if(i==count){	
			printf("��ѧ�Ų����ڣ�����������\n\n");	
			d++;
			if(d==2) {//Ϊ��ʹ�����������Ի����涨�˲���ѧ�Ŵ���
				printf("�����������Ȳ鿴һ������ѧ����Ϣ��\n\n");
				system("PAUSE");
				system("CLS");
				break;
			}
			system("PAUSE");
			system("CLS");
		}
		else {
			printf("�����ؿ��Ǻ�����ɾ����Ϣ��\n\n");	
			system("PAUSE");
			system("CLS");
			break;
		}
	}
	return count;		
}
	


void seeAllMassage(int count,Student *p)//�鿴������Ϣ
{
	int x;
   	UD;HD;UD;
	for(x=0;x<count;x++) {
	BT;UD;
	}
	system("PAUSE");
	system("CLS");
}

void statistics(int count,Student *p)//ͳ�Ʋ�ѯ����
{
	int i,j;int undersix=0,six=0,seven=0,eight=0,nine=0,ten=0;float sum;
	char head[6][7]={"ѧ��","����","Ӣ��","����","�����","ƽ����"};
	
	while(1) {
			int b=0;//������ʼֵ��ʹ�ð������ַ���ʱ����ʹ�ǲ��ܴ�����ַ���Ҳ�����˳��޸ģ�
				printf("\n\n\n");
				printf("            +++++---------------------------------++++\n");
		     	printf("            +--     1.���Ƴɼ�������85�ֵļ�¼     --+\n");
				printf("            +--     2.�в�����γ̵ļ�¼           --+\n");
				printf("            +--     3.ƽ������ָ����Χ�ļ�¼       --+\n");
				printf("            +--     4.ƽ�����ڸ������ε������ͱ��� --+\n");
				printf("            +--          �������ַ����˳�          --+\n");
		   	    printf("            +++++---------------------------------++++\n");
		     	printf("��ѡ�����Ĳ�����");
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
					printf("������δ�ҵ����Ƴɼ�������85�ֵļ�¼��\n\n");
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
					printf("������δ�ҵ����Ƴɼ��д���С��60�ֵļ�¼��\n\n");
				system("PAUSE");
				system("CLS");			
			}
			else if(b==3) {
				float a,b;int k=0;
				printf("ƽ���ֵķ�Χ��[����ֵ,����ֵ], ps�������˵�ֵ\n\n");
				printf("������ƽ���ֵ�����ֵ��");
				scanf("%f",&a);
				fflush(stdin);
				printf("\n");
				printf("������ƽ���ֵ�����ֵ��");
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
						printf("������δ�ҵ�ƽ������������Χ�ļ�¼��\n\n");
					system("PAUSE");
					system("CLS");					
			}
			else if(b==4) {
				printf("\n");
				printf("��ʾ��60������10��Ϊһ�������Σ�60������Ϊһ��������\n\n");
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
				printf("С��60�ֵ�����Ϊ:%d\n",undersix);
				printf("[60-69]������Ϊ��%d\n",six);
				printf("[70-79]������Ϊ��%d\n",seven);
				printf("[80-89]������Ϊ��%d\n",eight);
				printf("[90-99]������Ϊ��%d\n",nine);	
				printf("����100�ֵ�����Ϊ��%d\n\n",ten);
				sum=(float)(undersix+six+seven+eight+nine+ten);
				printf("ƽ�����ڸ��������εı���Ϊ��\n\n");
				printf(" <60  : [60-69] : [70-79] : [80-89] : [90-99] : =100\n\n");
				printf("%.2f%%  :   %.2f%%  :  %.2f%%   :  %.2f%%   :   %.2f%%  : %.2f%%\n\n",(undersix/sum)*100,(six/sum)*100,(seven/sum)*100,(eight/sum)*100,(nine/sum)*100,(ten/sum)*100);
				//�������ĸ����������һ����С�����������С����ֵ��
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


int encrypt()//�����㷨��KEYΪ�ܳ�
{
	FILE *fp=NULL;char w1[8],w2[8];int i,k=5;//������5������
	NEW:printf("������������(��λ����):");
			scanf("%6s",w1);//�ַ�����ɲ��õ�ַ��
			fflush(stdin);
			printf("\n\n");
			printf("���ٴ�ȷ������:");
			scanf("%6s",w2);//ֻȡ�������е�ǰ6λ��
			fflush(stdin);
			k--;
		if(strcmp(w1,w2)==0&&strlen(w1)==6) {
			for(i=strlen(w2)-1;i>=0;i--) {//�򵥼���
				w2[i]+=KEY;
			}
			if((fp=fopen(filename2,"w"))==NULL) {
				fprintf(stdin,"����ʧ�ܣ�");
				fclose(fp);
				return 0;
			}
			else {
				fputs(w2,fp);
				printf("���óɹ���\n\n");
				fclose(fp);
				return 1;	
			}
		}
		else {
			printf("����ʧ�ܣ����ٴ�����\n\n");
			if(k!=0) {
				goto NEW;
			}
		}	
	return 0;
}

int decrypt(char word[8])//�����㷨������һ��ʹ������м��ܣ�,KEYΪ�ܳ�
{
	FILE *fp=NULL;char w1[8],w2[8];int i=0,j=0;
	if((fp=fopen(filename2,"r"))==NULL) {
		FIRST:printf("�����ó�ʼ����(��λ����):");
			scanf("%6s",w1);//�ַ�����ɲ��õ�ַ��
			fflush(stdin);
			printf("\n\n");
			printf("���ٴ�ȷ������:");
			scanf("%6s",w2);//ֻȡ�������е�ǰ6λ��
			fflush(stdin);
		if(strcmp(w1,w2)==0&&strlen(w1)==6) {
			for(i=strlen(w2)-1;i>=0;i--) {//�򵥼���
				w2[i]+=KEY;
			}
			if(fp!=NULL)
			fclose(fp);
			if((fp=fopen(filename2,"w+"))==NULL) {
				fprintf(stderr,"����ʧ��!\n\n");
				fclose(fp);
				return 0;
			}
			else {
				fputs(w2,fp);
				fclose(fp);
				printf("���óɹ���\n\n");
				return 2;	
			}
		}
		else {
			printf("����ʧ�ܣ����ٴ�����\n\n");
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
		if(j!=0) {//�ļ���Ϊ��
			int k=6;//����5����������Ļ���
			for(i=strlen(w1)-1;i>=0;i--) {//����
				w1[i]-=KEY;
			}
			while(k) {
				k--;//�ж�Ϊ��ֵ���ټ�1�λ��ᣨ�������Ļ����Ǵ��������ﴫ�����ģ�����k��ʼ��Ϊ6��
				if(strcmp(w1,word)==0&&strlen(word)==6) {
					printf("\n\n\t\t������ȷ,��ӭ����ѧ���ɼ�����ϵͳ��\n\n\n");
					fclose(fp);
				return 1;
				}
				else {
					printf("�����������������(ʣ��%d��)\n\n",k);
					scanf("%6s",word);
					fflush(stdin);
				}
			}
		}
		else {
			SECOND:printf("�����ó�ʼ����(��λ����):");
			scanf("%6s",w1);//�ַ�����ɲ��õ�ַ��
			fflush(stdin);
			printf("\n\n");
			printf("���ٴ�ȷ������:");
			scanf("%6s",w2);//ֻȡ�������е�ǰ6λ�ַ�
			fflush(stdin);
		if(strcmp(w1,w2)==0&&strlen(w1)==6) {
			for(i=strlen(w2)-1;i>=0;i--) {//�򵥼���
				w2[i]+=KEY;
			}
			fclose(fp);
			if((fp=fopen(filename2,"w+"))==NULL) {
				fprintf(stdin,"����ʧ�ܣ�");
				fclose(fp);
				return 0;
			}
			else {
				fputs(w2,fp);
				printf("���óɹ���\n\n");
				fclose(fp);
				return 2;	
			}
		}
		else {
			printf("����ʧ�ܣ����ٴ�����\n\n");
			goto SECOND;
		}	
	}
	}
	printf("����������þ���\n\n");
	fclose(fp);
	return 0;
}

int menu()
{
	int i;
	printf("\n\n");
	printf("            +++++--------��ӭ����ѧ���ɼ�����ϵͳ-------+++++\n");
	printf("            +---------        1.�����ļ�           ---------+\n");
	printf("            +---------        2.¼��ѧ����Ϣ       ---------+\n");
	printf("            +---------        3.�޸�ѧ���ɼ�       ---------+\n");
	printf("            +---------        4.��ѯѧ���ɼ�       ---------+\n");
	printf("            +---------        5.ɾ��ѧ���ɼ�       ---------+\n");
	printf("            +---------        6.�鿴����ѧ����Ϣ   ---------+\n");
	printf("            +---------        7.ͳ�Ʋ�ѯģ��       ---------+\n");
	printf("            +---------        8.�����ļ�           ---------+\n");
	printf("            +---------        9.�޸�����           ---------+\n");
	printf("            +---------        0.�˳�����           ---------+\n");
   	printf("            +++++---------------------------------------+++++\n");
	printf("\n\t\t\t");
	do{
		printf("�����롾0-9����ִ�в�����");
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
	scanf("%6s",password); //ֻȡǰ��λ�����ַ�
	
	if(decrypt(password)) {
	printf("���ڶ����ļ���Ϣ......\n\n");
	count=readDocument(p);
 	printf("�ļ��е�ԭʼ�������£�\n\n");
 	seeAllMassage(count,p);
	i=menu();
	while(i!=0)
	{
		switch(i)
		{
		case 1:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<�����ļ�>>-----------------------\n\n");
    			count=readDocument(p);
    			printf("\n\t\t\t\t�ļ���ȡ�ɹ���\n\n");
    			system("PAUSE");
    			system("CLS");
    			break;
		case 2:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<¼����Ϣ>>-----------------------\n\n");
    			if(count!=MAXSIZE) {//ȷ�����鲻��Խ�磨�ﵽ���������ݼ�¼������
    				count=insertRecord(count,p);
    			}
    			else {
    				printf("\n\t\t\t\t�Ѵﵽ�������ݼ�¼������\n\n");
    				system("PAUSE");
    			}
    			break;
    	case 3:	system("CLS");
    			printf("\n\n");
				printf("\t\t-----------------------<<�޸ĳɼ�>>-----------------------\n\n");
    			modifyRecord(count,p);
    			break;	
		case 4:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<��ѯ�ɼ�>>-----------------------\n\n");
    			searchRecord(count,p);
    			break;
		case 5:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<ɾ���ɼ�>>-----------------------\n\n");
    			count=deleteRecord(count,p);
    			break;
    	case 6:	system("CLS");
    			printf("\n\n");
				printf("\t\t-----------------------<<�鿴������Ϣ>>-----------------------\n\n");
    			seeAllMassage(count,p);
    			break;
    	case 7:	system("CLS");
    			printf("\n\n");
				printf("\t-----------------------<<ͳ�Ʋ�ѯģ��>>-----------------------\n\n");
    			statistics(count,p);
    			break;
    	case 8:	system("CLS");
				printf("\n\n");
				printf("\t\t-----------------------<<�����ļ�>>-----------------------\n\n");
    			writeDocument(count,p);
    			printf("\n\t\t\t\t�ļ�����ɹ���\n\n");
    			system("PAUSE");
    			system("CLS");
    			break;
    	case 9:	system("CLS");
    			printf("\n\n");
				printf("\t\t-----------------------<<�޸�����>>-----------------------\n\n");
    			encrypt();
    			break;					
    	default:break;
		}	
		i=menu();
	}
	printf("\n\t\t\t�Ƿ���Ҫ�������������йز���?\n");
	printf("\t\t\tȷ�������롰1��,�����ַ���ȡ����");
	scanf("%d",&select);
 	fflush(stdin);
 		if(select==1) {
 			writeDocument(count,p);
    		printf("\n\t\t\t\t�ļ�����ɹ���\n\n");
    		system("PAUSE");
 		}
	printf("\n\n");
	printf("\n\n\t\t\tSee you next time\n\n");
	}
	else {
		printf("\n\t\tGoodbye!\n\n");
	}
}