export function listenForOrderEvent(tableId,data) {
    window.Echo.channel(`table.${tableId}`)
      .listen('OrderEvent', (e) => {
        console.log('接收到order事件:', e); 
        Object.assign(data.players.find(player => player.id === e.playerNewData.id), e.playerNewData);
        data.gameInfo.pillarInfo.order.push(e.newOrderPillar);
        data.gameInfo.orderColorInfo.splice(0, data.gameInfo.orderColorInfo.length, ...e.orderColorInfo);
      });
}
export function listenForNeedActionUpdated(tableId,data) {
    window.Echo.channel(`table.${tableId}`)
      .listen('NeedActionUpdated', (e) => {
        console.log('接收到更換玩家動作事件:', e); 
        data.players.find(player => player.id === e.nextPlayerId).needAction = 'putPillar'
        data.players.find(player => player.id === e.nowPlayerId).needAction = 'wait'
      });
}