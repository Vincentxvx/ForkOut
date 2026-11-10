import styles from './Page.module.css'
import { Link } from 'react-router-dom'
import logo from '../../../assets/forkout-mark-white.svg'

function RegisterPage() {
    return (
        <main className={styles.page}>
            <div className={styles.logo}>
                <img src={logo} alt="" width="48" height="48" />
                <span>ForkOut</span>
            </div>
            <form className={styles.card}>
                <h1 className={styles.title}>Sign up</h1>

                <label className={styles.field}>
                    Email address
                    <input type="email" autoComplete="email" />
                </label>

                <label className={styles.field}>
                    Username
                    <input type="text" autoComplete="username" />
                </label>

                <label className={styles.field}>
                    Password
                    <input type="password" autoComplete="new-password" />
                </label>

                <label className={styles.field}>
                    Password again
                    <input type="password" autoComplete="new-password" />
                </label>

                <button className={styles.submit} type="submit">Sign up</button>
                <p style={{ textAlign: 'center' }}>
                    <Link to="/login">Already have an account? Log in here</Link>
                </p>
            </form>
        </main>
    )
}

export default RegisterPage
