import { decideOrder,buyCard } from "../api"
export function chooseReelMethod(data,reels) {
    if(data.eventObject.action == 'order'){
        data.eventObject.reels = reels
        decideOrder(data.eventObject)
        data.eventObject = {}
    }
    if(data.eventObject.action == 'buyCard'){
        data.eventObject.needReelArray.forEach((element,index) => {
            if(typeof element == 'number'){
                element = reels
                if(typeof data.eventObject.needReelArray[index+1] == 'number'){
                    data.players.find(player => player.id === id).needAction = 'chooseReel'
                    return
                }
            }
        });
        buyCard(data.eventObject)
        data.eventObject = {}
    }
    
}
