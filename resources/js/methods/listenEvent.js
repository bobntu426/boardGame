export function listenForOrderEvent(tableId) {
    window.Echo.channel(`table.${tableId}`)
      .listen('OrderEvent', (e) => {
        console.log('接收到order事件:', e); 
        this.player = e.playerNewData
      });
}
export function listenForNeedActionUpdated(tableId) {
    window.Echo.channel(`table.${tableId}`)
      .listen('NeedActionUpdated', (e) => {
        console.log('接收到更換玩家動作事件:', e); 
      });
}