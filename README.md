MaxFileSize
=======================

Display maximum file size in posting and quick reply

Display goes with the account permissions (administrator can download larger files), and the settings in PHP and admin panel.

## Quick Install

1. Download the latest repository.
2. Unzip the downloaded release, and change the name of the folder to `MaxFileSize`.
3. In the `ext` directory of your phpBB board, create a new directory named `Sumanai` (if it does not already exist).
4. Copy the `MaxFileSize` folder to `phpBB/ext/Sumanai/` (if done correctly, you'll have the description file extension at (your forum root)/ext/Sumanai/MaxFileSize/composer.json).
5. Navigate in the ACP to `Customise -> Manage extensions`.
6. Look for `MaxFileSize` under the Disabled Extensions list, and click its `Enable` link.

## Uninstall
1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `MaxFileSize` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/Sumanai/MaxFileSize` folder.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
