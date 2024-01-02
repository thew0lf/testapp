pipeline {
    agent any
    options {
        buildDiscarder(logRotator(numToKeepStr: '5'))
      }
    environment {
        DOCKERHUB_CREDENTIALS = credentials('dockerhub')
      }
    stages {
    //Add any tools
    stage('Tools') {
          steps {
            script{
                echo "add tools for testing like composer"
            }

          }
    }

    // Tests
    stage('Build') {
      steps{
        script {
          echo "Build Docker File"
          sh 'docker build -t ggconsult/testapp .'
        }
      }
    }
    //
    stage('Login') {
      steps{
        script {
          echo "Running Tests";
          sh 'echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin'
        }
      }
    }
    //deploy to circleci for testing.. or
    stage('Deploy') {
        steps {
           sh 'docker push ggconsult/testapp'
        }
    }
    post{
        always {
            sh 'docker logout'
        }
    }
    }
}