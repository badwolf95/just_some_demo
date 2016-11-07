#include<iostream>
#include<string>
#include <fstream>
using namespace std;
string input;
char token[255]="";
int p_input;
int p_token;
string word[255][2];
char ch;
string tab[100] = {"if","then","else","end","procedure","repeat","while","read","write","int","until","char","const","eof"};


void getbc(){
    while(ch==' '){
        ch = input[p_input];
        p_input++;

    }
}
int letter(){
    return (ch>='a'&&ch<='z'||ch>='A'&&ch<='Z')?1:0;
}
int digit(){
    return (ch>='0'&&ch<='9')?1:0;
}
char m_getch(){
    ch = input[p_input];
    p_input++;
    return ch;
}
void concat(){
    token[p_token] = ch;
    //cout<<token[p_token]<<endl;
    //cout<<p_token<<endl;
    p_token++;
    token[p_token] = '\0';
}
int reserve(){
    int i=0;
    while(tab[i]!="eof"){
        if(tab[i]==token){
            return i+1;
        }
        i++;
    }
    return 16;
}
void retract(){
    p_input--;
}
void scaner(){
    p_token = 0;
    m_getch();
    getbc();
    if(letter()){
        while(letter()||digit()){
            concat();
            m_getch();
        }
        retract();
        //
        if(reserve() == 16){
            cout<<"(id="<<token<<")\n";
        }else{
            cout<<"("<<reserve()<<"="<<token<<")"<<endl;
        }

    }else if(digit()){
        while(digit()){
            concat();
            m_getch();
        }
        retract();
        //cout<<20<<"/"<<token<<endl;
        cout<<"(num="<<token<<")\n";
    }else switch(ch){
        case '=':
            m_getch();
            if(ch=='='){
                //cout<<39<<"=="<<endl;
                cout<<"("<<39<<",==)"<<endl;
            }else{
                retract();
                cout<<"("<<21<<",=)"<<endl;
            }
            break;
        case '+':
            cout<<"("<<22<<",+)"<<endl;break;
        case '-':
            cout<<"("<<23<<",-)"<<endl;break;
        case '*':
            cout<<"("<<24<<",*)"<<endl;break;
        case '/':
            m_getch();
            if(ch=='/'){
                //cout<<"("<<36<<",//)"<<endl;
                while(m_getch() && ch!='\n'){
                    cout<<ch;
                }
                cout<<endl;
                break;
            }else{
                cout<<"("<<25<<",/)"<<endl;break;
            }

        case '%':
            cout<<"("<<26<<",%)"<<endl;break;
        case '<':
            m_getch();
            if(ch=='>'){
                cout<<"("<<32<<",<>)"<<endl;
            }else if(ch=='<'){
                cout<<"("<<35<<",<<)"<<endl;
            }else{
                cout<<"("<<28<<",<)"<<endl;
            }
            break;
        case '>':
            m_getch();
            if(ch=='>'){
                cout<<"("<<36<<",>>)"<<endl;
            }else{
                cout<<"("<<29<<",>)"<<endl;
            }
            break;
        case '{':
            cout<<"("<<30<<",{)"<<endl;break;
        case '}':
            cout<<"("<<31<<",})"<<endl;break;
        case ';':
            cout<<"("<<32<<",;)"<<endl;break;
        case '[':
            cout<<"("<<33<<",[)"<<endl;break;
        case ']':
            cout<<"("<<34<<",])"<<endl;break;
        case '\'':
            cout<<"("<<35<<",')"<<endl;break;

        default:cout<<"error"<<endl;
    }

}
