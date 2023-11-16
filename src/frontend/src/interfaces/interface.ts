export interface Team {
    id: number;
    name: string;
}

export interface Season {
    id: number;
    name: string;
}

export interface Game {
    homeTeam: number;
    awayTeam: number;
    season: number;
    homeScore: number;
    awayScore: number;
}