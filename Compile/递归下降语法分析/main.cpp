#include<iostream>
#include<string>
#include <fstream>
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
        case '-':
            word[0] = "105";
            word[1] = "-";
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
        default:
            if(p_input>input.size()){
                word[0] = "998";
                word[1] = "endl";
            }else{
                word[0] = "999";
                word[1] = ch;
            }
        }
    cout<<"( "<<word[0]<<" , "<<word[1]<<" )\n";
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
�﷨�������֣�
*/
void error_show(string);
void match(string ,string);
void factor();
void term1();
void term();
void stmts();
void stmt();
void stmt1();
void bool0();
void bool1();
void expr();
void expr1();
void block();
void program();

void error_show(string info){
    cout<<"+-----------------------------------------error row "<<row<<": "<<info<<endl;
}
void match(string str,string err_info){
    if(str!=word[1]){
        error_show(err_info);
    }else{
        scaner();
    }
}
void factor(){
    if(word[1]=="("){
        scaner();
        expr();
        match(")","ȱ�٣�");
    }else if(word[0]!="100"&&word[0]!="101"){
        error_show("ȱ��factor");//һ��������Ҫ����ɨ�裬�ȴ����ݼ���ƥ�䵱ǰ�ַ�
    }else{
        scaner();
    }
}
void term1(){
    scaner();
    factor();
}
void term(){
    factor();
    while(word[1]=="*" || word[1]=="/"){
        term1();
    }
}
void stmt1(){
    if(word[1]=="else"){
        scaner();
        stmt();
    }
}
void bool0(){
    expr();
    if(word[1]=="<" || word[1]==">"){
        scaner();
        bool1();
    }else if(word[0]=="100"){
        error_show("ȱ��bool��ϵ�����");
        expr();
    }else{
        error_show("bool��ϵ��������");
    }
}
void bool1(){
    if(word[1]=="="){
        scaner();
    }
    expr();
}
void expr(){
    term();
    if(word[1]=="+" || word[1]=="-"){
        scaner();
        expr1();
    }
}
void expr1(){
    term();
    while(word[1]=="+"||word[1]=="-"){
        scaner();
        expr1();
    }
}
void stmt(){
    if(word[0]=="100"){
        scaner();
        match("=","ȱ�ٵȺ�");
        expr();
        match(";","ȱ�ٷֺ�");
    }else if(word[1]=="if"){
        scaner();
        match("(","ȱ�٣�");
        bool0();
        match(")","ȱ�٣�");
        stmt();
        stmt1();
    }else if(word[1]=="while"){
        scaner();
        match("(","ȱ�٣�");
        bool0();
        match(")","ȱ�٣�");
        stmt();
    }else if(word[1]=="do"){
        scaner();
        stmt();
        match("while","ȱ��while");
        match("(","ȱ�٣�");
        bool0();
        match(")","ȱ�٣�");
    }else if(word[1]=="break"){
        scaner();
        match(";","ȱ�٣�");
    }else if(word[1]=="{"){
        match("{","ȱ��������");
        block();
        match("}","ȱ���һ�����");
    }
}
void stmts(){
    stmt();
    while(word[0]=="100"||// ��ʶ��
          word[0]=="1"|| // if
          word[0]=="7"|| // while
          word[0]=="8"|| // do while
          word[0]=="15"){ // break
        stmt();
    }
}
void block(){
    while(word[1]!="}"){
        if(word[1]=="endl"){
            if(getline(fin,input)){
                row++;
                print_line();
                p_input = 0;
                scaner();
            }else{
                break;
            }
        }
        stmts();
    }
}
void program(){
    bool flag_end = false;//�Ƿ��Ѿ���ȡ���ļ�ĩβ
    while(getline(fin,input))
    {
        //�ʷ�����
        print_line();
        p_input = 0;
        scaner();
        while(word[1]=="endl"){
            if(getline(fin,input)){
                row++;
                print_line();
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
        match("{","ȱ��������");
        block();
        match("}","ȱ���һ�����");
    }
    return;
}


int main()
{
    row=1;
    program();
    return 0;
}

