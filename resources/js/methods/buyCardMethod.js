import { buyCard } from "../api"
export function buyCardMethod(data,{card,index}) {
    const id = data.playerId
    const player = data.players.find(player => player.id === id)
    if(!checkReource(player,card)){
        data.errorMessageArray.push('資源不足')
        setTimeout(() => {
          data.errorMessageArray.pop();
        }, 2000);
        return 
    }
    if(!data.eventObject.cardId){
        data.eventObject = {
            "playerId": id,
            "chooseColor":data.players.find(player => player.id === id).chooseColor,
            "cardId": [card.id],
            "needPoint":computeNeedPoint(index),
            "action":'buyCard',
            "needReelArray":[]
        }
    }else{
        data.eventObject.cardId.push(card.id)
    }
    if(card.buyEffect.reel>0){
        data.eventObject.needReelArray.push(card.buyEffect.reel)
    }
    if(card.function == 'gainDice'){
        data.players.find(player => player.id === id).needAction = `useExtraDice`
    }else {
        
        if(data.eventObject.needReelArray.length>0){
            data.players.find(player => player.id === id).needAction = `chooseReel${data.eventObject.needReelArray[0]}`

        }else{
            buyCard(data.eventObject)
            data.eventObject = {}
        }
    }
    
    console.log('購買卡片',data.eventObject);
    
  }
export function computeNeedPoint(index){
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
    return needPoint
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