import { decideOrder,buyCard } from "../api"
export function chooseReelMethod(data,reels) {
    data.eventObject.reels = reels
    if(data.eventObject.action == 'order'){
        decideOrder(data.eventObject)
    }
    if(data.eventObject.action == 'buyCard'){
        buyCard(data.eventObject)
    }
    console.log(data.eventObject)
}