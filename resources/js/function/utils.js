import axios from 'axios';

// Page User
export async function ConnecteUserData() {
    const token = localStorage.getItem('token');

    if (token) {
      try {
        const response = await axios.get('http://localhost:3000/api/auth/me', {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        return response.data;
      } catch (error) {
        if (error.response) {
          // Le token est expiré ou invalide
          localStorage.removeItem("token");
        }
      }
    }
  }

// Page Subscribe