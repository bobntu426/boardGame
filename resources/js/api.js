import axios from 'axios';

const API_URL = 'http://practice.test';
//axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
export const buyCard = async (mes) => {
  try {
    const response = await axios.put(`${API_URL}/players/buy-card`,(mes));
    console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('Error buy Cards:', error);
    throw error; 
  }
}
export const useCard = async (card) => {
  try {
    const response = await axios.put(`${API_URL}/players/use-card`,(card));
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