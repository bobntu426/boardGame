export function buyCardMethod(data,{card,index}) {
    const id = data.playerId
    const player = data.players.find(player => player.id === id)
    if(!checkReource(player,card)){
        data.errorMessageArray.push('資源不足')
        setTimeout(() => {
          data.errorMessageArray.pop();
        }, 2000);
    }
    
    
    let needPoint =0;
    switch (index) {
        case 0:
            needPoint = 1;
            break;
        case 1:
            needPoint = 3;
            break;
        case 2:
            needPoint = 5;
            break;
        case 3:
            needPoint = 7;
            break;
    }
    
    data.eventObject = {
        "playerId": id,
        "chooseColor":data.players.find(player => player.id === id).chooseColor,
        "cardId": card.id,
        "index":index,
        "action":'buycard'
    }
    
    //data.players.find(player=>player.needAction != 'wait').needAction = "chooseReel1"
    console.log('購買卡片',data.eventObject);
    console.log('骰子點數',data.gameInfo[`${data.players.find(player => player.id === id).chooseColor}Dice`]); 
  }
function checkReource(player,card){
    switch (card.color) {
        case 'green':
            return true
        case 'blue':
            if(player.money-card.cost.money<0){
                return false
            }
        case 'yellow':
            for (const [key, value] of Object.entries(card.cost)) {
                if(player[key]-value<0){
                    return false
                }
            }
        case 'purple':
            for (const [key, value] of Object.entries(card.cost)) {
                if(player[key]-value<0){
                    return false
                }
            }
    }
    return true
}