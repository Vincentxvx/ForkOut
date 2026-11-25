import { useState } from 'react'
import dummyRecipes from '../dummyRecipes'
import logo from '../../../assets/forkout-mark-white.svg'
import styles from './FeedPage.module.css'

function FeedPage() {
    const recipes = dummyRecipes
    const [index, setIndex] = useState(0)

    const recipe = recipes[index]
    const isFirst = index === 0
    const isLast = index === recipes.length - 1

    return (
        <div className={styles.page}>
            <header className={styles.header}>
                <img src={logo} alt="" width="32" height="32" />
                <span className={styles.logoText}>ForkOut</span>
            </header>

            <main className={styles.main}>
                {recipes.length === 0 && <p className={styles.message}>No recipes yet.</p>}

                {recipe && (
                    <section className={styles.feed} aria-label="Recipe feed">
                        <div className={styles.column}>
                            <button
                                className={styles.arrow}
                                type="button"
                                aria-label="Previous recipe"
                                disabled={isFirst}
                                onClick={() => setIndex(index - 1)}
                            >
                                ▲
                            </button>

                            <article className={styles.card}>
                                <p className={styles.counter}>{index + 1} / {recipes.length}</p>

                                {recipe.media_url ? (
                                    <img className={styles.media} src={recipe.media_url} alt={recipe.name} />
                                ) : (
                                    <div className={styles.mediaPlaceholder}>No photo yet</div>
                                )}

                                <div className={styles.info}>
                                    <p className={styles.creator}>
                                        <span className={styles.creatorAvatar} aria-hidden="true"></span>
                                        {recipe.username}
                                    </p>
                                    <h1 className={styles.name}>{recipe.name}</h1>
                                    <p className={styles.description}>{recipe.description}</p>
                                    <ul className={styles.tags}>
                                        <li>{recipe.prep_time} min</li>
                                        <li>{recipe.calorie} kcal</li>
                                        <li>{recipe.protein} g protein</li>
                                    </ul>
                                    <button className={styles.primary} type="button">Open recipe</button>
                                </div>
                            </article>

                            <button
                                className={styles.arrow}
                                type="button"
                                aria-label="Next recipe"
                                disabled={isLast}
                                onClick={() => setIndex(index + 1)}
                            >
                                ▼
                            </button>
                        </div>

                        <div className={styles.actions}>
                            <div className={styles.action}>
                                <button className={styles.actionButton} type="button" aria-label="Like">♥</button>
                                {recipe.like_count}
                            </div>
                            <div className={styles.action}>
                                <button className={styles.actionButton} type="button" aria-label="Add to meal plan">+</button>
                                Plan
                            </div>
                            <div className={styles.action}>
                                <button className={styles.actionButton} type="button" aria-label="Share">↗</button>
                                Share
                            </div>
                        </div>
                    </section>
                )}
            </main>
        </div>
    )
}

export default FeedPage