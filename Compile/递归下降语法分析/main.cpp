#include<iostream>
#include<string>
#include <fstream>
using namespace std;

/*
词法分析部分
*/
string input;
char token[255]="";
int p_input;
int p_token;
string word[2];
char ch;
string tab[100] = {"if","then","else","end","procedure","repeat","while","read","write","int","until","char","const","eof"};
void getbc()
{
    while(ch==' ')
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
        	sprintf(buf,"%d",i+1);//将int转换成string，先寄存在缓存buf中
        	string str(buf);//然后定义一个string类型的，以buf赋初值
            return str;//关键字
        }
        i++;
    }
    string str = "100";//标识符
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
            word[1] = token;  //标识符
        }
        else    //关键字
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
        word[1] = ")";
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
                break;
            }
            else
            {
                word[0] = "108";
                word[1] = "/";
                break;
            }

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
        default:
            word[0] = "999";
            word[1] = "error";
        }
    cout<<"("<<word[0]<<","<<word[1]<<")\n";
    return  word[0];
}
/*
语法分析部分：
*/

void block(string str){
    cout<<"block\n";
    return;
}
void program(string str){
    block(str);
    return;
}
int main()
{
    string in;
    fstream fin("in.txt");
    int row = 1;
    string str;
    while(getline(fin,in))
    {
        //词法分析
        input = in;
        cout<<"----------ROW "<<row++<<": ";
        for(int i=0; i<input.size(); i++)
        {
            cout<<input[i];
        }
        cout<<"--------------"<<endl;
        p_input = 0;
        while(p_input<input.size())
        {
            str = scaner();
            program(str);
        }

    }
    return 0;
}

