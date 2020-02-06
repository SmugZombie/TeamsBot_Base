# TeamsBot

What is it?

  - A simple (relatively) php implementation of a Microsoft Teams bot
  - A multi-bot hosting tool
  - Magic

### How to use

  - Make sure that you have a webserver that can server PHP
  - Clone this repository to a web accessible directory
  - Copy the full web path to this directory to enter into teams: (IE: https://www.example.com/teamsbot/)
  - Open teams, Click on the TEAM (not channel) ellipsis (...) that you want to add your bot to. Choose "Manage Team". A new tab opens on the right. From here click the "Apps" tab. In the bottom right there should be a small option for "Create an outgoing webhook"
  - Give your bot a name. (It's important you note this name as you will need it to create a bot)
  - Enter the URL you copied from before
  - Give your bot a description (This is really just for you and anyone who questions your bot's purpose)
  - Clicking Create will generate a key for you. Copy this and keep it in a safe place (an open notepad instance?) as you will need it in a minute. This will complete the steps to create the bot in teams. Now to create the bot server.
  - Back to the webserver, you need to copy config.example.json to config.json. Once copied, edit the file and replace the current key with the one you just copied (remember, it's probably in that open notepad instance...).
  - Now move into the "bots" folder. To make things simple, just copy the current demobot_bot.php to <nameofyourbot>_bot.php (all lowercase). (Entering the name you chose before in the <nameofyourbot> spot. (Leave out the < and > chars...))
  - Back to Teams: Start Typing "@<nameofyourbot>" and your bot should pop up in the list. Hit enter or click on it and then enter "status" - (IE: @mybot status)
  - Hopefully you followed all the steps and you see a positive response. Now you can edit the bot file to make it more useful to you. To add more bots simply add the generated keys to the config.json file and create a bot file in the bots directory. If you simply want to use the same bot across multiple channels you need to just ensure the bot name is the same and the new keys are added.
