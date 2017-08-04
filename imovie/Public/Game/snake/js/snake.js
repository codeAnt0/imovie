var left_excur= 0,top_excur=200,winWidth=616;
var headWidth=22,bodyWidth=22;
var topLimit=200,leftLimit= 0,bottomLimit=816,rightLimit=0;
var player=new Array(),itemArr=new Array();
var headObj,levelNumObj,scoreNumObj,hintShowObj;
var mainBack;
var lastOperation= 1,lastPressTime= 0;
var timer=null,refreshTimer;
var score= 0,level=1;
window.document.onkeyup = disableRefresh;
function disableRefresh(e){
    var keyNum = window.event ? e.keyCode : e.which;
    var manualDire=1;
    if(keyNum==37){
        manualDire=3;
    }else if(keyNum==38){
        manualDire=1;
    }else if(keyNum==39){
        manualDire=4;
    }else if(keyNum==40){
        manualDire=2;
    }
    var curTimeStamp=new Date().getTime();
    if(curTimeStamp-lastPressTime>=20){
        lastPressTime=curTimeStamp;
        if(lastOperation==1||lastOperation==2){
            if(manualDire==1||manualDire==2){
                return null;
            }
        }else if(lastOperation==3||lastOperation==4){
            if(manualDire==3||manualDire==4){
                return null;
            }
        }
        headObj.dire=manualDire;
        headObj.eye1.className="eye"+manualDire;
        headObj.eye2.className="eye"+manualDire;
        lastOperation=manualDire;
    }
}
function  operationShow(operation,content){
    var objTT=null;
    if(operation==1){
        objTT=levelNumObj
    }else if(operation==2){
        objTT=scoreNumObj;
    }else if(operation==3){
        objTT=hintShowObj;
        objTT.style.display="block";
        if(content.indexOf("Over")<0){
            setTimeout(function(){
                objTT.style.display="none";
            },1000);
        }
    }
    objTT.innerHTML=content;
}
function init(){
    left_excur=screen.width;
    leftLimit=parseInt(left_excur/2-winWidth/2);
    rightLimit=leftLimit+winWidth;
    mainBack=document.getElementById("mainWindow");
    mainBack.style.marginTop=top_excur+"px";
    mainBack.style.marginLeft=leftLimit+"px";
    var scoreObj=document.getElementById("score");
    hintShowObj=document.getElementById("hintShow");
    levelNumObj=document.getElementById("levelNum");
    scoreNumObj=document.getElementById("scoreNum");
    scoreObj.style.left=rightLimit-90+"px";
    scoreObj.style.top=topLimit+20+"px";
    hintShowObj.style.left=leftLimit+(rightLimit-leftLimit)/4+"px";
    hintShowObj.style.top=topLimit+120+"px";
    player[0]= new Head();
    for(var i=1;i<3;i++){
        player[i]=new SnakeBody();
    }
    moveStart(100);
    refreshItem();
}
var diyColor=0;
var colorArr=["#EE00EE","#C0FF3E","#9A32CD","#8B1A1A","#2F4F4F","#0000FF","#EE7621","#FF00FF","#8B4789","#4A708B"];
function refreshItem(){
    refreshTimer=setInterval(function(){
        if(itemArr.length<1){
            var x=parseInt((Math.random()*(winWidth/bodyWidth)))*bodyWidth+leftLimit;
            var y=parseInt((Math.random()*(winWidth/bodyWidth)) )*bodyWidth+topLimit;
            var item=document.createElement("div");
            item.className="snakeBody";
            item.style.left=x+"px";
            item.style.top=y+"px";
            diyColor=parseInt(Math.random()*10);
            item.style.backgroundColor=colorArr[diyColor];
            mainBack.appendChild(item);
            itemArr[itemArr.length]=item;
        }
    },3000);
}

function appendBody(str){
    var arr=str.split(",");
    for(var i=0;i<arr.length-1;i++){
        mainBack.removeChild(itemArr[parseInt(arr[i])]);
        itemArr.splice(i,1);
        player[player.length]=new SnakeBody();
        score+=6;
        operationShow(2,score);
        operationShow(3,"&nbsp;&nbsp;&nbsp;+6");
        var isHintShow=false;
        if(score==60){
            operationShow(1,level=2);isHintShow=true;
            moveStart(80);
        }else if(score==120){
            operationShow(1,level=3);isHintShow=true;
            moveStart(60);
        }else if(score==180){
            operationShow(1,level=4);isHintShow=true;
            moveStart(50);
        }else if(score==240){
            operationShow(1,level=5);isHintShow=true;
            moveStart(40);
        }else if(score==300){
            operationShow(1,level=6);isHintShow=true;
            moveStart(26);
        }
        if(isHintShow){
            operationShow(3,"恭喜你，进阶难度"+(level)+"！");
        }
    }
}
function moveStart(speed){
    if(timer!=null){
        window.clearInterval(timer);
    }
 timer=setInterval(function(){
           var beforeLeft= headObj.tab.offsetLeft;
            var beforeTop=headObj.tab.offsetTop;
           var isStop=false;
            if(headObj.dire==1){
                if(beforeTop<=topLimit){
                    isStop=true;
                }
                if(!isStop)
                headObj.tab.style.top=beforeTop-bodyWidth+"px";
            }else if(headObj.dire==2){
                if(beforeTop+headWidth>=bottomLimit){
                    isStop=true;
                }if(!isStop)
                headObj.tab.style.top=beforeTop+bodyWidth+"px";
            }else if(headObj.dire==3){
                if(beforeLeft<=leftLimit){
                    isStop=true;
                }if(!isStop)
                headObj.tab.style.left=beforeLeft-bodyWidth+"px";
            }else if(headObj.dire==4){
                if(beforeLeft+headWidth>=rightLimit){
                    isStop=true;
                }if(!isStop)
                headObj.tab.style.left=beforeLeft+bodyWidth+"px";
            }

             var removeStr="";
             for(var j=0;j<itemArr.length;j++){
                 var item=itemArr[j];
                 var itemX=item.offsetLeft,itemY=item.offsetTop;
                 if(itemX==headObj.tab.offsetLeft&&itemY==headObj.tab.offsetTop){
                     removeStr+=j+",";
                 }
             }
             if(removeStr.length>0){
                 appendBody(removeStr);
             }

            for(var i=1;i<player.length;i++){
                var tempObj=player[i];
                var tempLeft=tempObj.tab.offsetLeft;
                var tempTop=tempObj.tab.offsetTop;
                if(tempLeft==headObj.tab.offsetLeft&&tempTop==headObj.tab.offsetTop){
                    isStop=true;
                }
                tempObj.tab.style.left=beforeLeft+"px";
                tempObj.tab.style.top=beforeTop+"px";
                beforeLeft=tempLeft;
                beforeTop=tempTop;
            }
     if(isStop){
         operationShow(3,"&nbsp;&nbsp;Game Over");
         window.clearInterval(timer);
         window.clearInterval(refreshTimer);
     }
 },speed);
}

function Head(){
    this.dire=1;
    var head= document.createElement("header");
    var eye1=document.createElement("div");
    var eye2=document.createElement("div");
    eye1.className="eye"+this.dire;
    eye2.className="eye"+this.dire;
    head.id="head";
    head.appendChild(eye1);
    head.appendChild(eye2);
    head.style.left=(leftLimit+308)+"px";
    head.style.top=(topLimit+308)+"px";
    mainBack.appendChild(head);
    this.tab=head;
    this.eye1=eye1;
    this.eye2=eye2;
    headObj=this;
}
function SnakeBody(){
    var obj;
    if(player.length==1){
        obj=player[0];
    }else{
        obj=player[player.length-1];
    }
    var body=document.createElement("div");
    body.className="snakeBody";
    var left= 0,top=0;
    var s_left=obj.tab.offsetLeft,s_top=obj.tab.offsetTop;
    switch (headObj.dire){
        case 1:
            left=s_left;
            top=s_top+headWidth;
            break;
        case 2:
            left=s_left;
            top=s_top-headWidth;
            break;
        case 3:
            left=s_left+headWidth;
            top=s_top;
            break;
        case 4:
            left=s_left-headWidth;
            top=s_top;
            break;
    }
    body.style.left=left+"px";
    body.style.top=top+"px";
    body.style.backgroundColor=colorArr[diyColor];
    mainBack.appendChild(body);
    this.tab=body;
}