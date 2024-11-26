export function listenForOrderEvent(tableId) {
    window.Echo.channel(`table.${tableId}`)
      .listen('OrderEvent', (e) => {
        console.log('接收到新遊戲process事件:', e); 
      });
}
export function listenForNeedActionUpdated(tableId) {
    window.Echo.channel(`table.${tableId}`)
      .listen('NeedActionUpdated', (e) => {
        console.log('接收到更換玩家動作事件:', e); 
      });
}