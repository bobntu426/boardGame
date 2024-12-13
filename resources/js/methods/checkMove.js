export function checkMove(data,workerNum,needPoint,props,callback) {
    const id = data.playerId
    const player = data.players.find(player => player.id === id);
    let dicePoint = 0;
    if(player.chooseColor!='normal'){
      dicePoint = data.gameInfo[`${player.chooseColor}Dice`]
    }
    props.dicePoint = dicePoint
    if(data.players.find(player => player.id === id).needAction == "putPillar"){
        if(!data.players.find(player => player.id === id).chooseColor){
          data.errorMessageArray.push('請選擇家族成員')
          setTimeout(() => {
            data.errorMessageArray.pop();
          }, 2000);
        }else{
          if(workerNum+dicePoint<needPoint){
            data.errorMessageArray.push('點數不夠')
            setTimeout(() => {
              data.errorMessageArray.pop();
            }, 2000);
          }else{
            callback(data,props)
          }
          
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