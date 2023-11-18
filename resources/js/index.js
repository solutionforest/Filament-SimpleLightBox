import fslightbox from 'fslightbox';

window.fslightbox = fslightbox;

window.SimpleLightBox = {
    getViewerURL(url) {
        // https://gist.github.com/theel0ja/b9e44a961f892ccf43e217ab74b9417b
        // Extract the file extension
        let extension = url.split('.').pop();

        switch (extension) {
            case 'pdf':
                return `https://docs.google.com/viewer?url=${url}&embedded=true`;
            case 'doc':
            case 'docx':
            case 'xls':
            case 'xlsx':
            case 'ppt':
            case 'pptx':
                return `https://view.officeapps.live.com/op/embed.aspx?src=${url}`;
            default:
                return url;
        }
    },
    createIframe(url) {
        // Create a new iframe element
        document.getElementById("tmp-iframe") ? .remove();
        let iframe = document.createElement('iframe');
        iframe.src = this.getViewerURL(url);
        iframe.id = "tmp-iframe";
        iframe.className = "fslightbox-source";
        iframe.frameBorder = "0";
        iframe.allow = "autoplay; fullscreen";
        iframe.style = "width: 80vw; height: 80vh;";
        iframe.setAttribute("allowFullScreen", "");
        document.body.appendChild(iframe);
    },
    open(e, url) {
        e.preventDefault();
        const lightbox = new FsLightbox();
        if (url !== undefined) {
            this.createIframe(url);
            lightbox.props.sources = [document.getElementById("tmp-iframe")];
            lightbox.open();
            lightbox.props.onClose = function(instance) {
                document.getElementById("tmp-iframe") ? .remove();
            }
            return;
        }
        if (e.target.src !== undefined) {
            lightbox.props.sources = [e.target.src];
            lightbox.open();
        }
    },
    close() {}
}