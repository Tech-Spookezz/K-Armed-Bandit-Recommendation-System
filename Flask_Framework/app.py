from flask import Flask, render_template, request

import pandas as pd
import numpy as np

# Load the dataset
file_path = "movie_ratings.csv"
df = pd.read_csv(file_path)

# Constants
NUM_INTERACTIONS = 1000
NUM_CUMULATIVE_REWARDS = 100

import pandas as pd
import numpy as np


# Load the dataset
file_path = "movie_ratings.csv"
df = pd.read_csv(file_path)

# Constants
NUM_INTERACTIONS = 1000
NUM_CUMULATIVE_REWARDS = 100

class MultiArmedBandit:
    def __init__(self, num_arms):
        self.num_arms = num_arms
        self.counts = np.zeros(num_arms)
        self.values = np.zeros(num_arms)
        self.total_counts = 0

    def epsilon_greedy(self, epsilon):
        if np.random.rand() < epsilon:
            action = np.random.randint(self.num_arms)
        else:
            action = np.argmax(self.values)
        return action

    def ucb1(self):
        ucb_values = self.values + np.sqrt(2 * np.log(self.total_counts + 1) / (self.counts + 1e-5))
        action = np.argmax(ucb_values)
        return action

    def exp3(self, gamma):
        probabilities = np.exp(gamma * self.values) / np.sum(np.exp(gamma * self.values))
        action = np.random.choice(self.num_arms, p=probabilities)
        return action

    def thompson_sampling(self):
        sampled_values = np.random.normal(self.values, 1.0 / (self.counts + 1e-5))
        action = np.argmax(sampled_values)
        return action

    def softmax(self, tau):
        probabilities = np.exp(self.values / tau) / np.sum(np.exp(self.values / tau))
        action = np.random.choice(self.num_arms, p=probabilities)
        return action

    def update(self, action, reward):
        self.counts[action] += 1
        self.values[action] += (reward - self.values[action]) / self.counts[action]
        self.total_counts += 1

def recommend_movies_epsilon_greedy(user_id, epsilon, mab):
    user_movies = df[df['user_id'] == user_id]['movie_id'].unique()
    movies_to_predict = [movie for movie in df['movie_id'].unique() if movie not in user_movies]

    if not movies_to_predict:
        return {"title": "No more movies to recommend.", "genre": "", "director": "", "actor1": "", "actor2": "", "rating": 0}

    action = mab.epsilon_greedy(epsilon) % len(movies_to_predict)
    recommended_movie = df[df['movie_id'] == movies_to_predict[action]]
    return recommended_movie.to_dict(orient='records')[0]

def recommend_movies_ucb1(user_id, mab):
    user_movies = df[df['user_id'] == user_id]['movie_id'].unique()
    movies_to_predict = [movie for movie in df['movie_id'].unique() if movie not in user_movies]

    if not movies_to_predict:
        return {"title": "No more movies to recommend.", "genre": "", "director": "", "actor1": "", "actor2": "", "rating": 0}

    action = mab.ucb1() % len(movies_to_predict)
    recommended_movie = df[df['movie_id'] == movies_to_predict[action]]
    return recommended_movie.to_dict(orient='records')[0]

def recommend_movies_exp3(user_id, gamma, mab):
    user_movies = df[df['user_id'] == user_id]['movie_id'].unique()
    movies_to_predict = [movie for movie in df['movie_id'].unique() if movie not in user_movies]

    if not movies_to_predict:
        return {"title": "No more movies to recommend.", "genre": "", "director": "", "actor1": "", "actor2": "", "rating": 0}

    action = mab.exp3(gamma) % len(movies_to_predict)
    recommended_movie = df[df['movie_id'] == movies_to_predict[action]]
    return recommended_movie.to_dict(orient='records')[0]

def recommend_movies_thompson_sampling(user_id, mab):
    user_movies = df[df['user_id'] == user_id]['movie_id'].unique()
    movies_to_predict = [movie for movie in df['movie_id'].unique() if movie not in user_movies]

    if not movies_to_predict:
        return {"title": "No more movies to recommend.", "genre": "", "director": "", "actor1": "", "actor2": "", "rating": 0}

    # Choose action only if there are movies to predict
    action = mab.thompson_sampling() % len(movies_to_predict)
    recommended_movie = df[df['movie_id'] == movies_to_predict[action]]
    return recommended_movie.to_dict(orient='records')[0]

def recommend_movies_softmax(user_id, tau, mab):
    user_movies = df[df['user_id'] == user_id]['movie_id'].unique()
    movies_to_predict = [movie for movie in df['movie_id'].unique() if movie not in user_movies]

    if not movies_to_predict:
        return {"title": "No more movies to recommend.", "genre": "", "director": "", "actor1": "", "actor2": "", "rating": 0}

    action = mab.softmax(tau) % len(movies_to_predict)
    recommended_movie = df[df['movie_id'] == movies_to_predict[action]]
    return recommended_movie.to_dict(orient='records')[0]

def collaborative_filtering_recommendation(user_id):
    # Placeholder logic for collaborative filtering
    user_movies = df[df['user_id'] == user_id]['movie_id'].unique()
    movies_to_predict = [movie for movie in df['movie_id'].unique() if movie not in user_movies]

    if not movies_to_predict:
        return {"title": "No more movies to recommend.", "genre": "", "director": "", "actor1": "", "actor2": "", "rating": 0}

    # Choose a random movie for placeholder
    random_movie = np.random.choice(movies_to_predict)
    recommended_movie = df[df['movie_id'] == random_movie]
    return recommended_movie.to_dict(orient='records')[0]

def content_based_recommendation(user_id):
    # Placeholder logic for content-based recommendation
    user_movies = df[df['user_id'] == user_id]['movie_id'].unique()
    movies_to_predict = [movie for movie in df['movie_id'].unique() if movie not in user_movies]

    if not movies_to_predict:
        return {"title": "No more movies to recommend.", "genre": "", "director": "", "actor1": "", "actor2": "", "rating": 0}

    # Choose a random movie for placeholder
    random_movie = np.random.choice(movies_to_predict)
    recommended_movie = df[df['movie_id'] == random_movie]
    return recommended_movie.to_dict(orient='records')[0]

# Main function to choose the best MAB algorithm based on performance
def choose_best_mab_algorithm(user_id, num_arms):
    epsilon = 0.1  # Set your epsilon value
    gamma = 0.2    # Set your gamma value
    tau = 0.5      # Set your tau value

    mab = MultiArmedBandit(num_arms=num_arms)

    # Simulate user interactions and update MAB values
    for _ in range(NUM_INTERACTIONS):
        action = mab.epsilon_greedy(epsilon)
        # Simulate reward based on the chosen action and user preferences from your dataset
        reward = np.random.normal(0, 1)
        mab.update(action, reward)

    # Choose the best-performing algorithm based on cumulative reward
    cumulative_rewards = [0] * num_arms
    for _ in range(NUM_CUMULATIVE_REWARDS):
        cumulative_rewards[0] += np.random.normal(mab.values[0], 1)
        cumulative_rewards[1] += np.random.normal(mab.values[1], 1)
        cumulative_rewards[2] += np.random.normal(mab.values[2], 1)
        # Add more lines if there are more arms

    best_algorithm = np.argmax(cumulative_rewards)
    return best_algorithm, mab

app = Flask(__name__)

@app.route('/')
def user_input():
    return render_template('user_input.html')

@app.route('/choose_algorithm', methods=['POST'])
def choose_algorithm():
    user_id = request.form.get('user_id')
    return render_template('choose_algorithm.html', user_id=user_id)

@app.route('/get_recommendations', methods=['POST'])
def get_recommendations():
    user_id = int(request.form.get('user_id'))
    algorithm = int(request.form.get('algorithm'))

    # Call the appropriate recommendation function based on the selected algorithm
    if algorithm == 1:
        recommendation = collaborative_filtering_recommendation(user_id)
    elif algorithm == 2:
        recommendation = content_based_recommendation(user_id)
    elif algorithm == 3:
        num_arms = len(df['movie_id'].unique())
        best_algorithm, mab = choose_best_mab_algorithm(user_id, num_arms)
        # Call the specific MAB recommendation function based on the best algorithm
        if best_algorithm == 0:
            recommendation = recommend_movies_epsilon_greedy(user_id, epsilon=0.1, mab=mab)
        elif best_algorithm == 1:
            recommendation = recommend_movies_ucb1(user_id, mab=mab)
        elif best_algorithm == 2:
            recommendation = recommend_movies_exp3(user_id, gamma=0.2, mab=mab)
        elif best_algorithm == 3:
            recommendation = recommend_movies_thompson_sampling(user_id, mab=mab)
        elif best_algorithm == 4:
            recommendation = recommend_movies_softmax(user_id, tau=0.5, mab=mab)
    else:
        return "Invalid algorithm choice"

    # Render recommendations as HTML
    return render_template('recommendations_partial.html', recommendation=recommendation)

if __name__ == "__main__":
    app.run(debug=True)
