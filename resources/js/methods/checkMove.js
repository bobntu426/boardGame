export function checkMove(data,workerNum,needPoint,props,callback) {
    const id = data.playerId
    const player = data.players.find(player => player.id === id);
    let dicePoint = 0;
    if(player.chooseColor!='normal'){
      dicePoint = data.gameInfo[`${player.chooseColor}Dice`]
    }
    if(player.needAction == "useExtraDice"){
      
      dicePoint = 0;
    }
    props.dicePoint = dicePoint
    if(player.needAction == "putPillar"||(player.needAction == "useExtraDice"&&callback.name == 'buyCardMethod')){
        if(!player.chooseColor&&player.needAction != "useExtraDice"){
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
          }else if(player.needAction == "useExtraDice"){
            if(props.card.id == data.eventObject.cardId){
              data.errorMessageArray.push('此卡已被選擇')
              setTimeout(() => {
                data.errorMessageArray.pop();
              }, 2000);
            }else{
              console.log(data.eventObject)
              callback(data,props)
            }
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
        data.errorMessageArray.push('請執行指定動作')
        setTimeout(() => {
          data.errorMessageArray.pop();
        }, 2000);
    }
      
  }