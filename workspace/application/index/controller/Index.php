<?php
namespace app\index\controller;
use think\Validate;


class Index extends \think\Controller
{
    public function index(){
      if(session('user')){
        return $this->redirect('/index/user');
      }
      return $this->fetch();
    }

    public function register(){

     $rule = [
         ['email','require|email|unique:user','请填写注册邮箱|邮箱格式不正确|该邮箱已注册，请直接登录或更换邮箱'],
            ['password','require|length:6,16','密码不能为空|密码长度应为6-16位'],
            ['re_password','require|confirm:password','请确认密码|两次输入密码不一致'],
     ];
     $validate = new Validate($rule);
     if(!$validate->check(input('post.'))){
         return show(0,$validate->getError());
     }
        $data['email'] = input('post.email');
        $data['password'] = addMd5(input('post.password'));
        $data['create_time'] = $data['update_time'] = time();
        $data['token'] = addMd5_token($data['email'],$data['password']);
        $res = model('User')->insert($data);
        if(!$res){
            return show(0,'注册失败，请联系网站管理员修复');
        }else{
            if(true === sendEmail($data['email'],$data['token'])){
                return show(1,'注册成功，请登录邮箱激活账号后登录');
            }else{
                return show(0,'邮件发送失败');
            }
        }
    }

   public function register_confirm(){

      $map['email'] = input('param.email');
      $map['token'] = input('param.token');
      $res = model('User')->where($map)->find();
      if($res){
        $data['status'] = 1;
        $data['update_time'] = time();
        model('User')->where($map)->update($data);
        return $this->redirect('/index');
      }else{
        echo "<script>alert('激活失败');</script>";
      }
    }

    public function login(){

      $rules = [
        ['email','require','请填写用户邮箱'],
        ['password','require','请填写密码']
      ];
      $validate = new Validate($rules);
      if($validate->check(input('post.'))){
        $map['email'] = input('post.email');
        if(!model('User')->where($map)->find()){
          return show(0,'该用户名不存在');
        }
        $map['status'] = '1';
        if(!model('User')->where($map)->find()){
          return show(0,'用户未激活，请至邮箱点击链接进行激活');
        }
        $map['password'] = addMd5(input('post.password'));
        $res = model('User')->where($map)->find();
        if($res){
          session('user',$res);
          return show(1,'登录成功');
        }else{
          return show(0,'用户名或密码错误');
        }
      }else{
        return show(0,$validate->getError());
      }
    }

}
