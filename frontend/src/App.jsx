import './App.css'
import { Navigate, Route, Routes } from 'react-router-dom'
import LoginPage from './features/auth/pages/LoginPage'
import RegisterPage from './features/auth/pages/RegisterPage'
import FeedPage from './features/feed/pages/FeedPage'

function App() {

  return (
    <Routes>
      <Route path="/" element={<Navigate to="/login" replace />} />
      <Route path="/login" element={<LoginPage />} />
      <Route path="/register" element={<RegisterPage />} />
      <Route path="/feed" element={<FeedPage />} />
    </Routes>
  )
}

export default App
