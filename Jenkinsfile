pipeline {
    agent any
    stages {
    //Add any tools
    stage('Tools') {
          steps {
            script{
                echo "add tools for testing like composer"
                sh 'PATH="/usr/local/bin:/opt/homebrew/bin:/opt/homebrew/sbin:/usr/local/bin:/System/Cryptexes/App/usr/bin:/usr/bin:/bin:/usr/sbin:/sbin:/var/run/com.apple.security.cryptexd/codex.system/bootstrap/usr/local/bin:/var/run/com.apple.security.cryptexd/codex.system/bootstrap/usr/bin:/var/run/com.apple.security.cryptexd/codex.system/bootstrap/usr/appleinternal/bin"
                    export DOTNET_ROOT="/opt/homebrew/opt/dotnet/libexec"
                    export PATH="$PATH:/Users/gcuevas/.dotnet/tools"
                    export PATH="$PATH:/Users/$USER/.dotnet/tools"
                    export PATH="$PATH:/Users/gcuevas/Library/Python/3.9/bin"

                    export PATH="/opt/homebrew/opt/openjdk@17/bin:$PATH"
                    export CPPFLAGS="-I/opt/homebrew/opt/openjdk@17/include"
                    brew install php'
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
          #sh 'vendor/bin/phpunit ./tests';

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