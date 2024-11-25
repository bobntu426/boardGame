export function decideOrderMethod(data) {
    if(data.player.needAction == "putPillar"){
        if(!data.player.chooseColor){
          data.messageArray.push('請選擇家族成員')
          setTimeout(() => {
            data.messageArray.pop();
          }, 3000);
        }else{
          data.eventObject = {
            "playerId": data.player.id,
            "chooseColor":data.player.chooseColor,
            "action":'order'
          }
          data.actionPlayer.needAction = "chooseReel1"
          console.log('搶先手',data.eventObject);
        }      
      }
      else if(data.player.needAction == "wait"){
        data.messageArray.push('不是您的回合')
        setTimeout(() => {
          data.messageArray.pop();
        }, 3000);
      }else{
        data.messageArray.push('請執行指示動作')
        setTimeout(() => {
          data.messageArray.pop();
        }, 3000);
      }
      
  }