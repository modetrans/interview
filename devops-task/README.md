# Task Delivery
* Please don't fork, branch or create a pull request within this repository. 
* Clone it and do your work there.
* When the task is ready, **Email** your zipped solution back to us (Only first submit count unless otherwise directed).

# Devops Test Task
Thank you for applying to Mode Transportation! We'd like to see how you can build out infrastructure and CI/CD.

## Hello World PHP App
Provided in `src` is a "hello world" PHP app with 2 files.

## Part 1: Infrastructure
Your goal is to set up this app so that it runs on AWS infrastructure. 
You can choose any appropriate AWS technology.

Your output for this step should be a **single command** (or very few commands) that fully initializes and configures all required infrastructure.
Please update this **README** file as part of the solution to **document the execution procedure, assumptions, considerations**, etc.

If you would like, you can set up the infrastructure and provide a working link.

## Part 2: CI/CD
Your goal for this step is to set up an automated build and deployment pipeline. Please use a SaaS provider that has
the ability to be configured entirely by file. GitHub Actions, AWS CodePipeline, GitLab, TravisCI, CircleCI, or any other provider with a free tier.

The pipeline steps should be:

1. Check out the repository
2. Install any dependencies
3. Build the application
4. Deploy the code update to AWS

For extra credit, you can come up with a process to display the current version number (defined as the build number)
as an HTTP header or within the web application.

Your deliverable here should be a configuration file that we could run. You can also share access to the SaaS to show us
your own working pipeline.

Good luck!
