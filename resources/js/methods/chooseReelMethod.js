import { decideOrder } from "../api"
export function chooseReelMethod(data,reels) {
    data.eventObject.reels = reels
    if(data.eventObject.action == 'order'){
        decideOrder(data.eventObject)
    }
    console.log(data.eventObject)
}