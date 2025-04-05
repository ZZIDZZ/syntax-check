def set_phrase
        @phrase = Phrase.find(params[:id])
      rescue ActiveRecord::RecordNotFound
        respond_to do |format|
          format.json { render json: {}.to_json, status: :not_found }
          format.html {
            flash[:error] = t('idioma.record_not_found')
            redirect_to phrases_path
          }
        end
      end