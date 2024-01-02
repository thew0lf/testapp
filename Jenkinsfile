pipeline {
    agent any
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
          echo "Add necessary build scripts"

        }
      }
    }
    stage('Test') {
      steps{
        script {
          echo "Running Tests";
          //sh 'vendor/bin/phpunit ./tests';

        }
      }
    }
    //deploy to circleci for testing.. or
    stage('Deploy') {
     steps{
        script {
            sh '/usr/local/bin/docker --debug compose -f docker-compose.yml up -d --build';

        }
        }
      }

    }
}