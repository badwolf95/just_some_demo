#include<iostream>
#include<string>
#include <fstream>
#include <stack>
#include <queue>
using namespace std;

/*
�ʷ���������
*/
fstream fin("in.txt");
string input;
char token[255]="";
int p_input;
int p_token;
string word[2];
char ch;
int row;
string tab[100] = {"if","then","else","end","procedure","repeat","while","do","read","write","int","until","char","const","break","eof"};

void getbc(){
    while(ch==' '||ch=='\t')
    {
        ch = input[p_input];
        p_input++;

    }
}
int letter()
{
    return (ch>='a'&&ch<='z'||ch>='A'&&ch<='Z')?1:0;
}
int digit()
{
    return (ch>='0'&&ch<='9')?1:0;
}
char m_getch()
{
    ch = input[p_input];
    p_input++;
    return ch;
}
void concat()
{
    token[p_token] = ch;
    p_token++;
    token[p_token] = '\0';
}
string reserve()
{
    int i=0;
    char buf[100];
    while(tab[i]!="eof")
    {
        if(tab[i]==token)
        {
        	sprintf(buf,"%d",i+1);//��intת����string���ȼĴ��ڻ���buf��
        	string str(buf);//Ȼ����һ��string���͵ģ���buf����ֵ
            return str;//�ؼ���
        }
        i++;
    }
    string str = "100";//��ʶ��
    return str;
}
void retract()
{
    p_input--;
}
string scaner()
{
    p_token = 0;
    m_getch();
    getbc();
    if(letter())
    {
        while(letter()||digit())
        {
            concat();
            m_getch();
        }
        retract();
        if(reserve() == "100")
        {
            word[0] = "100";
            word[1] = token;  //��ʶ��
        }
        else    //�ؼ���
        {
            word[0] = reserve();
            word[1] = token;
        }

    }
    else if(digit())
    {
        while(digit())
        {
            concat();
            m_getch();
        }
        retract();
        word[0] = "101";
        word[1] = token;
    }
    else switch(ch)
        {
        case '=':
            m_getch();
            if(ch=='=')
            {
                word[0] = "102";
                word[1] = "==";

            }
            else
            {
                retract();
                word[0] = "103";
                word[1] = "=";

            }
            break;
        case '+':
            word[0] = "104";
            word[1] = "+";
            break;
        case '*':
            word[0] = "106";
            word[1] = "*";
            break;
        case '/':
            m_getch();
            if(ch=='/')
            {
                word[0] = "107";
                word[1] = "//";
                while(m_getch() && ch!='\n')
                {
                    cout<<ch;
                }
                cout<<endl;
            }
            else
            {
                retract();
                word[0] = "108";
                word[1] = "/";
            }
            break;
        case '%':
            word[0] = "109";
            word[1] = "%";
            break;
        case '<':
            m_getch();
            if(ch=='>')
            {
                word[0] = "110";
                word[1] = "<>";
            }
            else if(ch=='<')
            {
                word[0] = "111";
                word[1] = "<<";
            }
            else
            {
                retract();
                word[0] = "112";
                word[1] = "<";
            }
            break;
        case '>':
            m_getch();
            if(ch=='>')
            {
                word[0] = "113";
                word[1] = ">>";
            }
            else
            {
                retract();
                word[0] = "114";
                word[1] = ">";
            }
            break;
        case '{':
            word[0] = "115";
            word[1] = "{";
            break;
        case '}':
            word[0] = "116";
            word[1] = "}";
            break;
        case ';':
            word[0] = "117";
            word[1] = ";";
            break;
        case '[':
            word[0] = "118";
            word[1] = "[";
            break;
        case ']':
            word[0] = "119";
            word[1] = "]";
            break;
        case '\'':
            word[0] = "120";
            word[1] = "\'";
            break;
        case '(':
            word[0] = "121";
            word[1] = "(";
            break;
        case ')':
            word[0] = "122";
            word[1] = ")";
            break;
        case '-':
            m_getch();
            if(ch == '>'){
                word[0] = "123";
                word[1] = "->";
            }else{
                retract();
                word[0] = "105";
                word[1] = "-";
            }
            break;
        case '|':
            word[0] = "124";
            word[1] = "|";
            break;
        default:
            if(p_input>input.size()){
                word[0] = "998";
                word[1] = "endl";
            }else{
                word[0] = "999";
                word[1] = ch;
            }
        }
    //cout<<"( "<<word[0]<<" , "<<word[1]<<" )\n";
    return  word[0];
}
void print_line(){
    cout<<"\n===================ROW "<<row<<": ";
    for(int i=0; i<input.size(); i++)
    {
        cout<<input[i];
    }
    cout<<""<<endl;
}

/*
LR�﷨�������֣�***********************************************************
*/
void error_show(string);
void match(string ,string);
void program();
void oneline();
void getge();
void getvt();
bool vt_exist(string);
void mk_table();
void make_tb();


string vts[30];// �洢���ս����string����
int vts_k = 0;// ���ս��������
string ges[30][30];// �洢�ķ��Ķ�ά���飬ÿ����һ���ķ��Ĵ洢��ÿ����Ԫ����һ���ַ�
int ges_k = 0;// �ķ����ʽ������
int ges_k_k[30];// ÿ�б��ʽ���ַ�����
string state[30];
string table[20][100] = {
    {
        " ","+","*","(",")","i","#","E","T","F"
    },
    {
        "0"," "," ","S4"," ","S5"," ","1","2","3"
    },
    {
        "1","S6"," "," "," "," ","ACC"," "," "," "
    },
    {
        "2","R2","S7"," ","R2"," ","R2"," "," "," "
    },
    {
        "3","R4","R4"," ","R4"," ","R4"," "," "," "
    },
    {
        "4"," "," ","S4"," ","S5"," ","8","2","3"
    },
    {
        "5","R6","R6"," ","R6"," ","R6"," "," "," "
    },
    {
        "6"," "," ","S4"," ","S5"," "," ","9","3"
    },
    {
        "7"," "," ","S4"," ","S5"," "," "," ","10"
    },
    {
        "8","S6"," "," ","S11"," "," "," "," "," "
    },
    {
        "9","R1","S7"," ","R1"," ","R1"," "," "," "
    },
    {
        "10","R3","R3"," ","R3"," ","R3"," "," "," "
    },
    {
        "11","R5","R5"," ","R5"," ","R5"," "," "," "
    }
};

//�ж��ַ��Ƿ����ս��
bool vt_exist(string str){
    for(int i=0;i<vts_k;i++){
        if(str == vts[i]){
            return true;
            break;
        }
    }
    return false;
}
//��ȡ�ķ���lastvt()����
//��ȡ�ս��
void getvt(){
    p_input = 0;
    getline(fin,input);
    print_line();
    while(p_input<input.size()-1){
        scaner();
        vts[vts_k++] = word[1];
    }
//    cout<<"��ȡ��һ�еõ����ս����";
//    for(int i=0;i<vts_k;i++){
//        cout<<vts[i]<<"  ";
//        //table[0][i+1] = vts[i];//���������
//        //table[i+1][0] = vts[i];//���������
//    }
//    cout<<endl<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<endl;;
    //��������� ��̬
    cout<<"������ȷ�����---------------------------------------"<<endl;
    for(int i=0;i<13;i++){
        cout<<"|  ";
        for(int j=0;j<10;j++){
            cout<<table[i][j]<<"    ";
        }
        cout<<"      |"<<endl;
    }
    cout<<"-------------------------------------------------------"<<endl;
}
//��ȡ����ķ�G[E]
void getge(){
    getline(fin,input);
    row++;
    int n = input[0]-'0';
    //cout<<"G[E]�ı��ʽ��:"<<n<<"��"<<endl;
    for(int i=0;i<n;i++){
        getline(fin,input);
        row++;
        print_line();
        p_input = 0;

        ges_k_k[i] = 0;
        while(p_input < input.size()){
            scaner();
            ges[ges_k][ges_k_k[i]] += word[1];
            ges_k_k[i]++;
        }
        ges_k++;
//        cout<<"�����ķ�: ";
//        for(int j=0;j<ges_k_k[i];j++){
//            cout<<ges[i][j]<<"";
//        }
//        cout<<endl;
    }
}
int getRow(string str){
    for(int i=1;i<13;i++){
        if(str == table[i][0]){
            return i;
        }
    }
    return 0;
}
int getCol(string str){
    for(int i=1;i<10;i++){
        if(str == table[0][i]){
            return i;
        }
    }
    return 0;
}
void oneline(){
    string todo; // ����
    string stk_anl = "#"; // ����ջ
    int stk_k = 0; // ����ջָ��
    string s_input = input; // ����ջ
    int s_input_k = 0; // ����ջָ��
    int state_k = 0; // ״̬ջָ��
    state[state_k] = "0"; // ״̬ջ
    int row; // ������
    int col; // ������
    int ge_k; // ��Լʱ��Ҫ�õ����ķ��±�
    int ii=0; // ���

    // Ҫ��ʼ������
    //�Ȳ鶯��
    row = getRow(state[state_k]); //���У���ǰ״̬ջջ��
    col = getCol(word[1]); // ���У���ǰ�������
    todo = table[row][col]; // ��������Ӧ����
    /******����ʽ���������*******/
    cout<<"���\t״̬ջ\t\t����ջ\t\t��������Ŵ�\t\t����\n";
    cout<<++ii<<"\t"; // ���
    cout<<state[state_k]; //״̬ջ
    cout<<"\t\t";
    cout<<stk_anl[stk_k]; // ����ջ
    cout<<"\t\t";
    for(int j=s_input_k;j<s_input.size();j++){
        cout<<s_input[j]; // ��������Ŵ�
    }
    cout<<"\t\t"<<todo<<endl; // ����
    /************������************/
    while(todo!="ACC"){ // ��ǰ��������ACC���ܾ�ѭ��������
        if(todo[0]=='S'){  // ��ջ����
            //״̬ջ����
            if(todo.size()>2){
                state[++state_k] = todo[1];
                state[state_k] += todo[2];
            }else{
                state[++state_k] = todo[1];
            }
            stk_anl[++stk_k] = word[1].c_str()[0]; // ����ջ����
            s_input_k++; // ����ջָ�����
            scaner(); // ɨ����һ������
        }else if(todo[0]=='R'){ // ��Լ����
            // ��¼��Լ�õ����ķ��±�
            if(todo.size()>2){
                ge_k = todo[1]-'0';
                ge_k *= 10;
                ge_k += todo[2]-'0';
            }else{
                ge_k = todo[1]-'0';
            }
            ge_k--; // ʵ���Ǵ�0��ʼ����Ҫ��һ
            stk_k -= ges_k_k[ge_k]-2; // ����ջָ�룬��ջN�������ƶ���ʾ
            state_k -= ges_k_k[ge_k]-2; // ״̬ջָ�룬ͬ��
            stk_anl[++stk_k] = ges[ge_k][0].c_str()[0]; // ��Լ������ջ
            // ���¹�Լ��״̬ջ����״̬
            row = getRow(state[state_k]); // �鵱ǰ״̬ջջ��
            col = getCol(ges[ge_k][0].c_str()); // �鵱ǰ����ջջ����Ҳ���ǹ�Լ���ķ���
            state[++state_k] = table[row][col].c_str(); // ����״̬ջ
        }else{
            // ״̬����
            cout<<"error--------------------------��"<<todo<<endl;
        }
        // ����һ������
        row = getRow(state[state_k]);
        col = getCol(word[1]);
        todo = table[row][col];
        /******����ʽ���������*******/
        cout<<++ii<<"\t";
        for(int j=0;j<=state_k;j++){
            cout<<state[j];
        }
        cout<<"\t\t";
        for(int j=0;j<=stk_k;j++){
            cout<<stk_anl[j];
        }
        cout<<"\t\t";
        for(int j=s_input_k;j<s_input.size();j++){
            cout<<s_input[j];
        }
        cout<<"\t\t"<<todo<<endl;
    }
}
//���ж�ȡ�����д���
void program(){
    bool flag_end = false;//�Ƿ��Ѿ���ȡ���ļ�ĩβ
    while(getline(fin,input))
    {
        p_input = 0;
        scaner();
        // ��������
        while(word[1]=="endl"){
            if(getline(fin,input)){
                row++;
                //print_line();
                p_input = 0;
                scaner();
            }else{
                flag_end = true;//�Ѿ���ĩβ����ע�����治�ٽ���ƥ��,ֱ��break�˳�
                break;
            }
        }
        if(flag_end){
            break;
        }
        //��ʽ�ÿ���
        cout<<"|\n|\n|\n|\n|\n";
        for(int i=0;i<3;i++){
            cout<<">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>\n";
        }
        print_line();
        row++;
        oneline();
    }
    cout<<"\n\n\n";
    return;
}
void match(string str,string err_info){
    if(str!=word[1]){
        error_show(err_info);
    }else{
        scaner();
    }
}
void error_show(string info){
    cout<<"+-----------------------------------------error row "<<row<<": "<<info<<endl;
}


int main()
{
    row=1;
    getvt();
    getge();
    program();
    return 0;
}

