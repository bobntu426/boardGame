export function checkMove(data,props,callback) {
    const id = data.playerId
    if(data.players.find(player => player.id === id).needAction == "putPillar"){
        if(!data.players.find(player => player.id === id).chooseColor){
          data.errorMessageArray.push('請選擇家族成員')
          setTimeout(() => {
            data.errorMessageArray.pop();
          }, 2000);
        }else{
            callback(data,props)
        }      
    }else if(data.players.find(player => player.id === id).needAction == "wait"){
        data.errorMessageArray.push('不是您的回合')
        setTimeout(() => {
          data.errorMessageArray.pop();
        }, 2000);
      
    }else{
        data.errorMessageArray.push('目前無法執行指示動作')
        setTimeout(() => {
          data.errorMessageArray.pop();
        }, 2000);
    }
      
  }