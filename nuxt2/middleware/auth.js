// export default function ({ $auth, $axios, store, redirect }) {
//     $axios.onRequest(config => {
//       const token = localStorage.getItem('token');
//       const name = localStorage.getItem('name');
//       const email = localStorage.getItem('email');
//       if (token) {
//         config.headers.common['Authorization'] = `Bearer ${token}`;
//       } else {
//         redirect('/login');
//       }
//       return config;
//     });

//     // if (!$auth.loggedIn) {
//     //     return redirect('/login');
//     //   }
//   }

export default function ({ $auth, redirect }) {
  if (!$auth.loggedIn) {
    return redirect('/login')
  }
}