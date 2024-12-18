export function listenForOrderEvent(tableId,data) {
    window.Echo.channel(`table.${tableId}`)
      .listen('OrderEvent', (e) => {
        console.log('接收到order事件:', e); 
        Object.assign(data.players.find(player => player.id === e.playerNewData.id), e.playerNewData);
      });
}
export function listenForToNextPlayer(tableId,data) {
    window.Echo.channel(`table.${tableId}`)
      .listen('ToNextPlayer', (e) => {
        console.log('接收到更換玩家動作事件:', e); 
        data.players.find(player => player.id === e.nextPlayerId).needAction = 'putPillar'
        data.players.find(player => player.id === e.nowPlayerId).needAction = 'wait'
      });
}
export function listenForResetEvent(tableId,data) {
  window.Echo.channel(`table.${tableId}`)
    .listen('ResetEvent', (e) => {
      console.log('接收到reset家動作事件:', e); 
      Object.assign(data.players.find(player => player.id === e.playerNewData.id), e.playerNewData);
    });
}