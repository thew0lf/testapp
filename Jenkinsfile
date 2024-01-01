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
         // sh   './bin/compose.sh'
        }
      }
    }
    stage('Test') {
      steps{
        script {
          echo "Running Tests";
          //sh 'cd src;./bin/phpunit';

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