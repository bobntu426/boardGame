export function decideOrderMethod(data) {
  const id = data.playerId
  data.eventObject = {
    "playerId": id,
    "chooseColor":data.players.find(player => player.id === id).chooseColor,
    "action":'order'
  }
  data.players.find(player=>player.needAction != 'wait').needAction = "chooseReel1"
  console.log('搶先手',data.eventObject);
}