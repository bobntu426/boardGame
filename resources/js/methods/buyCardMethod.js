export function buyCardMethod(data,{card,index}) {
    const id = data.playerId
    
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