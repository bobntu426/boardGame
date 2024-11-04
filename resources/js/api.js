import axios from 'axios';

const API_URL = 'http://practice.test';


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
export const fetchCards = async () => {
  try {
    const response = await axios.get(`${API_URL}/cards`);
    return response.data; 
  } catch (error) {
    console.error('Error fetching cards:', error);
    throw error; 
  }
  
};
export const fetchMyCards = async () => {
  try {
    const response = await axios.get(`${API_URL}/users/getCard`);
    console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('Error fetching my Cards:', error);
    throw error; 
  }
}
export const buyCard = async (cardId) => {
  try {
    const response = await axios.put(`${API_URL}/buyCard/${cardId}`);
    console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('Error fetching my Cards:', error);
    throw error; 
  }
}
export const useCard = async (cardId) => {
  try {
    const response = await axios.put(`${API_URL}/useCard/${cardId}`);
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
export const createTable = async (tableId) => {
  
  try {
    const response = await axios.post(`${API_URL}/tables`);
    //console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('create table fail:', error);
    throw error; 
  }
}
export const joinTable = async (tableId) => {
  try {
    const response = await axios.put(`${API_URL}/joinTable/${tableId}`);
    //console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('join table fail', error);
    throw error; 
  }
}
export const leaveTable = async (tableId) => {
  try {
    const response = await axios.put(`${API_URL}/leaveTable/${tableId}`);
    //console.log(response.data);
    return response.data; 
  } catch (error) {
    console.error('leave table fail', error);
    throw error; 
  }
}