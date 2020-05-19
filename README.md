Companion article project to forward errors in your Twilio application to a Slack channel.
### AWS
You'll need the AWS credentials of an IAM user with the following permissions:
- APIGateway
- CloudFormation
- AWS Lambda
- IAM

### Slack
A valid [Slack Hook URL](https://my.slack.com/services/new/incoming-webhook) from your preferred workspace.

### Running Locally
- Copy .env.example file to .env in the project root folder and update the Slack hook URL
- Start the inbuilt PHP server with `php -S localhost:8888`. 
- Open an `ngrok` tunnel on port `8888` with `ngrok http 8888`
- Point your Twilio Debugger webhook URL to your ngrok URL.
- Profit.
