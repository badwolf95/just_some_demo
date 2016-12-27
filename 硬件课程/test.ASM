;********************;
;* 8255薄膜按键实验 *;
;********************;
 a8255        equ 288H    ;8255 A口    
 b8255	  equ 289H    ;8255 B口
 c8255        equ 28aH    ;8255 C口
 k8255        equ 28bH    ;8255控制口

 ;*******************
;*    8254分频     *
;*******************
io8253a        equ 280h
io8253b        equ 281h
io8253c        equ 283h

;数据定义
data segment
 table1    dw 0110H,0120H,0210H,0220H,0910H,0920H,0A10H,0A20H
		dw 0510H,0520H,0610H,0620H,0D10H,0D20H,0E10H,0E20H	    ;键盘扫描码表
 LED       DB 3FH,06H,5BH,4FH,3FH,06H,5BH,4FH
	     DB 3FH,06H,5BH,4FH,3FH,06H,5BH,4FH   ;LED段码表，0,1,2,3,
 char  db '0123012301230123'                    ;字符表
mes   db 0ah,0dh,'PLAY ANY KEY IN THE SMALL KEYBOARD! ',0ah,0dh
       db 'IT WILL BE ON THE SCREEN! END WITH E ',0ah,0dh,'$'
 key_in db 0h
data ends
stacks segment stack    ;堆栈空间
     db 100 dup (?)
stacks ends


;代码段
code segment
    assume cs:code,ds:data,ss:stacks,es:data
;初始化定时器
start:mov dx,io8253c     ;向8254写控制字
    mov al,36h       ;使0通道为工作方式3
    out dx,al
    mov ax,1000      ;写入循环计数初值1000
    mov dx,io8253a
    out dx,al        ;先写入低字节
    mov al,ah
    out dx,al        ;后写入高字节
    mov dx,io8253c
    mov al,72h       ;设8254通道1工作方式1
    out dx,al
    mov ax,1000      ;写入循环计数初值1000
    mov dx,io8253b
    out dx,al        ;先写低字节
    mov al,ah
    out dx,al        ;后写高字节

;键盘——————
        cli
        mov ax,data
        mov ds,ax
        mov es,ax
    	  mov ax,stacks
        mov ss,ax
        mov dx,offset mes       ;显示提示信息
        mov ah,09
        int 21h  
        MOV DX,k8255            ;初始化8255控制字
        mov al,81h
        out dx,al 
main_key:
        call key                ;get a char in (key_in) and display it
        call disply               	;调显示子程序，显示得到的字符
        cmp byte ptr key_in,'E'
        jnz main_key
        mov ax,4c00h            ;if (dl)='E' return to EXIT!
        int 21h                 ;退出
key proc near
key_loop:
        mov ah,1
        int 16h
        jnz exit                    ;pc键盘有键按下则退出
       

;无光有声时控制灯亮
	mov dx,c8255
	in al,dx
	cmp al,73h
	jz out_b


        mov dx,c8255
        mov al,0fh
        out dx,al
        in al,dx                    ;读行扫描值
        and al,0fh
        cmp al,0fh
        jz key_loop                 ;未发现有键按下则转
        call delay                  ;delay for amoment
        mov ah,al
        MOV DX,k8255
        mov al,88h
        out dx,al
        mov dx,c8255
        mov al,ah
        or al,0f0h
        out dx,al
        in al,dx                    ;读列扫描值
        and al,0f0h
        cmp al,0f0h
        jz key_loop                 ;未发现有键按下则转
        
        mov si,offset table1        ;键盘扫描码表首址
        mov di,offset char          ;字符表首址
        mov cx,16                   ;待查表的表大小
key_tonext:
        cmp ax,[si]                 ;cmp (col,row) with every word
        jz key_findkey              ;in the table
        dec cx
        jz key_loop                 ;未找到对应扫描码
        add si,2
        inc di
        jmp key_tonext
key_findkey:
        mov dl,[di]
        mov ah,02
        int 21h            ;显示查找到的键盘码
        mov byte ptr key_in,dl
key_waitup:
        MOV DX,k8255
        mov al,81h
        out dx,al
        mov dx,c8255
        mov al,0fh
        out dx,al
        in al,dx           ;读行扫描值
        and al,0fh
        cmp al,0fh
        jnz key_waitup     ;按键未抬起转
        call delay         ;delay for amoment
        ret
exit:        mov byte ptr key_in,'E'
        ret
key endp




;输出相应脉冲
out_b proc near
	push ax
	mov al,02h
	mov dx,b8255
	out dx,al
	pop ax
	ret
out_b endp





delay proc near
        push ax            ;delay 50ms--100ms
        mov ah,0
        int 1ah
        mov bx,dx
delay1:
        mov ah,0
        int 1ah
        cmp bx,dx
        jz delay1
        mov bx,dx
delay2:
        mov ah,0
        int 1ah
        cmp bx,dx
        jz delay2
        pop ax
       ret
delay endp
DISPLY    PROC NEAR
    	PUSH ax
    	MOV BX,OFFSET LED
    	MOV AL,byte ptr key_in
      SUB al,30h
      CMP al,09h  
      JNG  DIS2
       SUB al,07h
DIS2:  XLAT
    	 MOV DX,a8255
    	 OUT DX,AL                     ;输出显示数据，段码
       POP AX
    	 RET
DISPLY    ENDP






  code ends
    end start
