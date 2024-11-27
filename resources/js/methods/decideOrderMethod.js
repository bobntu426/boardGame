export function decideOrderMethod(data) {
    const id = data.playerId
    if(data.players.find(player => player.id === id).needAction == "putPillar"){
        if(!data.players.find(player => player.id === id).chooseColor){
          data.errorMessageArray.push('請選擇家族成員')
          setTimeout(() => {
            data.errorMessageArray.pop();
          }, 3000);
        }else{
          data.eventObject = {
            "playerId": id,
            "chooseColor":data.players.find(player => player.id === id).chooseColor,
            "action":'order'
          }
          
          data.players.find(player=>player.needAction != 'wait').needAction = "chooseReel1"
          console.log('搶先手',data.eventObject);
        }      
      }
      else if(data.players.find(player => player.id === id).needAction == "wait"){
        data.errorMessageArray.push('不是您的回合')
        setTimeout(() => {
          data.errorMessageArray.pop();
        }, 3000);
      }else{
        data.errorMessageArray.push('目前無法執行指示動作')
        setTimeout(() => {
          data.errorMessageArray.pop();
        }, 3000);
      }
      
  }