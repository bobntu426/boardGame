export function getBoardPillarInfo(players) {
    const pillarPositions = {
        'green': [null, null, null, null],
        'blue': [null, null, null, null],
        'yellow': [null, null, null, null],
        'purple': [null, null, null, null],
        'hand': [],
        'order': [],
        'production': [],
        'otherProduction': [],
        'harvest': [],
        'otherHarvest': [],
        'earnMoney': [],
        'earnWorker': [],
        'earnMoneyMilitary': [],
        'earnTwoReel': []
    };

    players.forEach(player => {
        const playerPillarPositions = {
            'black': player.blackPillar, 
            'white': player.whitePillar,
            'red': player.redPillar,
            'normal': player.normalPillar
        };

        Object.entries(playerPillarPositions).forEach(([color, position]) => {
            if (position.startsWith('green') || position.startsWith('blue') || position.startsWith('yellow') || position.startsWith('purple')) {
                const [towerColor, index] = position.split('_');
                
                // Update the tower position
                pillarPositions[towerColor][parseInt(index) - 1] = {
                    playerId: player.id,
                    playerColor: player.color,
                    color: color
                };
            } else {
                pillarPositions[position].push({
                    playerId: player.id,
                    playerColor: player.color,
                    color: color
                });
            }
        });
    });

    return pillarPositions;
}

