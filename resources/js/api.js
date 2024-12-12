import axios from 'axios';

const API_URL = import.meta.env.VITE_APP_URL;

export const getUsers = async () => {
  try {
    const response = await axios.get(`${API_URL}/users`);
    return response.data; 
  } catch (error) {
    console.error('Error fetching users:', error);
    throw error; 
  }
};

export const login = async (credentials) => {
  try {
    const response = await axios.post(`${API_URL}/authenticate`,credentials);
    return response.data; 
  } catch (error) {
    console.error('Error handle login:', error);
    throw error; 
  }
  
};
export const logout = async () => {
  try {
    const response = await axios.get(`${API_URL}/logout`);
    return response.data; 
  } catch (error) {
    console.error('Error handle logout:', error);
    throw error; 
  }
  
};
export const checkLogin = async () => {
  try {
    const response = await axios.get(`${API_URL}/check-login`);
    console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('check login fail', error);
    throw error; 
  }
}
export const register = async (userData) => {
  try {
    const response = await axios.post(`${API_URL}/register`, userData);
    return response.data; 
  } catch (error) {
    console.error('Error updating user:', error);
    throw error; // 抛出错误以便调用者处理
  }
};
export const fetchUser = async () => {
  try {
    const response = await axios.get(`${API_URL}/user`);
    return response.data; 
  } catch (error) {
    console.error('Error fetching users:', error);
    throw error; 
  }
};
export const getTableCards = async (tableId) => {
  try {
    const response = await axios.get(`${API_URL}/tables/${tableId}/cards`);
    console.log(response)
    return response.data; 
    
  } catch (error) {
    console.error('Error fetching cards:', error);
    throw error; 
  }
  
};
export const getPlayerCards = async (playerId) => {
  try {
    const response = await axios.get(`${API_URL}/players/${playerId}/cards`);
    console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('Error fetching my Cards:', error);
    throw error; 
  }
}

export const fetchTables = async () => {
  try {
    const response = await axios.get(`${API_URL}/tables`);
    return response.data; 
  } catch (error) {
    console.error('Error fetching tables:', error);
    throw error; 
  } 
};
export const createTable = async (tableMes) => {
  
  try {
    
    const response = await axios.post(`${API_URL}/tables`,tableMes);
    //console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('create table fail:', error);
    throw error; 
  }
}
export const joinTable = async (tableId) => {
  try {
    const response = await axios.put(`${API_URL}/join-table/${tableId}`);
    //console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('join table fail', error);
    throw error; 
  }
}
export const leaveTable = async (tableId) => {
  try {
    const response = await axios.put(`${API_URL}/leave-table/${tableId}`);
    //console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('leave table fail', error);
    throw error; 
  }
}
export const getTablePlayers = async (tableId) => {
  try {
    const response = await axios.get(`${API_URL}/players/${tableId}`);
    return response.data; 
  } catch (error) {
    console.error('get player fail', error);
    throw error; 
  }
}
export const getGameInfo = async (tableId) => {
  try {
    const response = await axios.get(`${API_URL}/games/${tableId}`);
    return response.data; 
  } catch (error) {
    console.error('get gameInfo fail', error);
    throw error; 
  }   
}
export const decideOrder = async (eventObject) => {
  try {
    const response = await axios.put(`${API_URL}/games/decide-order`,eventObject);
    return response.data; 
  } catch (error) {
    console.error('handle decideOrder fail', error);
    throw error; 
  }   
}
export const reset = async (eventObject) => {
  try {
    const response = await axios.put(`${API_URL}/games/reset`,eventObject);
    return response.data; 
  } catch (error) {
    console.error('handle reset fail', error);
    throw error; 
  }   
}
export const endTurn = async (eventObject) => {
  try {
    const response = await axios.put(`${API_URL}/games/end-turn`,eventObject);
    return response.data; 
  } catch (error) {
    console.error('handle reset fail', error);
    throw error; 
  }   
}
export const buyCard = async (eventObject) => {
  try {
    const response = await axios.put(`${API_URL}/players/buy-card`,eventObject);
    console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('Error buy Cards:', error);
    throw error; 
  }
}