// Generated using webpack-cli https://github.com/webpack/webpack-cli

const path = require('path');

const isProduction = process.env.NODE_ENV == 'production';


const config = {
    entry: {
        home: './app/views/pages/js/home.js',
        signUp: './app/views/pages/js/signUp.js',
        signIn: './app/views/pages/js/signIn.js',
        firstAccess: './app/views/pages/js/firstAccess.js',
        wapp: './app/views/pages/js/wapp.js',
        editAccount: './app/views/pages/js/editAccount.js',
        ranking: './app/views/pages/js/ranking.js',
        users: './app/views/pages/js/users.js',
        train: './app/views/pages/js/train.js',
        exam: './app/views/pages/js/exam.js',
        exams: './app/views/pages/js/exams.js'
    },
    output: {
        path: path.resolve(__dirname, './app/views/pages/js/dist'),
    },
    devServer: {
        open: true,
        host: 'localhost',
    },
    plugins: [
    ],
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/i,
                loader: 'babel-loader',
            },
            {
                test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
                type: 'asset',
            },

            // Add your rules for custom modules here
            // Learn more about loaders from https://webpack.js.org/loaders/
        ],
    },
};

module.exports = () => {
    if (isProduction) {
        config.mode = 'production';
        
        
    } else {
        config.mode = 'development';
    }
    return config;
};
