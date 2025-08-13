
# Gutenberg Custom Block Hero with ACF pro
 ## Description

This project is a custom WordPress block that creates dynamic hero section with data using Advanced Custom Fields (ACF) Pro. It has the options to customize the background:
- **Color ** Plain color;
- **Image **- Choose a image;
- **YouTube **- Just get the URL of a YouTube video. And choose the options:
	▶️ Autoplay
	🔁 Loop video
	🔇 Mute video.
## Requirements

- **WordPress** (latest version recommended)
- **ACF Pro** plugin (required for custom block and flexible content support)

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/<your-username>/<new-repo-name>.git
   cd <new-repo-name>
   git checkout main
   ```

2. **Copy the plugin/theme files**
   - Place the `<new-repo-name>` folder inside your WordPress `wp-content/plugins/` or `wp-content/themes/` directory, depending on your setup.

3. **Install and activate ACF Pro**
   - Download ACF Pro from [https://www.advancedcustomfields.com/pro/](https://www.advancedcustomfields.com/pro/)
   - Upload and activate the plugin in your WordPress admin panel.

4. **Activate the block**
   - If using as a plugin, activate "acfblock" from the WordPress Plugins screen.
   - If using as a theme part, ensure your theme loads the block files.

5. **Add the Hero Block**
   - In the WordPress block editor, add the "Hero" block to your page or template.
   - Configure the background type as YouTube, Image, or Color.
   - For YouTube, paste a valid YouTube video URL and adjust options (autoplay, loop, mute, etc.).

## Testing

- Open your site in the frontend and/or the WordPress editor.
- The hero section should display with your chosen background (YouTube video, image, or color).
- For YouTube backgrounds, the video will cover the full width of the hero section and play according to your settings.

## Notes

- **ACF Pro is required** for block registration and flexible content fields.
- The block is designed to be responsive and work in both the frontend and the WordPress block editor.
- For best results, use high-quality YouTube videos with a 16:9 aspect ratio.

## Support

For issues or questions, please open an issue on this repository.
